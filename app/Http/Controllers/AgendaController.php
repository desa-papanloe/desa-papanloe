<?php
// app/Http/Controllers/AgendaController.php (Public/Frontend)

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgendaController extends Controller
{
    /**
     * Display a listing of agenda (Public)
     */
    public function index(Request $request)
    {
        try {
            // Base query for active agenda
            $query = Agenda::where('status', 'aktif')->with(['creator:id,name']);

            // Filter by kategori
            if ($request->filled('kategori') && $request->kategori !== 'all') {
                $query->where('kategori', $request->kategori);
            }

            // Search functionality
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhere('tempat', 'like', "%{$search}%")
                      ->orWhere('penyelenggara', 'like', "%{$search}%");
                });
            }

            // Sort options
            $sortBy = $request->get('sort', 'tanggal_mulai');
            switch ($sortBy) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'popular':
                    $query->orderBy('views', 'desc');
                    break;
                case 'priority':
                    $priorities = ['urgent', 'tinggi', 'normal', 'rendah'];
                    $query->orderByRaw("FIELD(prioritas, '" . implode("','", $priorities) . "')");
                    break;
                case 'tanggal_mulai':
                default:
                    $query->orderBy('tanggal_mulai', 'asc');
                    break;
            }

            // Paginate results
            $agenda = $query->paginate(12)->withQueryString();

            // Get data for page
            $categories = Agenda::getKategoris();

            // Get featured agenda
            $featuredAgenda = Cache::remember('featured_agenda', 600, function () {
                return Agenda::where('status', 'aktif')
                    ->where('is_featured', true)
                    ->where('tanggal_mulai', '>=', now())
                    ->orderBy('tanggal_mulai', 'asc')
                    ->limit(3)
                    ->get();
            });

            // Get upcoming agenda
            $upcomingAgenda = Cache::remember('upcoming_agenda', 300, function () {
                return Agenda::where('status', 'aktif')
                    ->where('tanggal_mulai', '>=', now())
                    ->orderBy('tanggal_mulai', 'asc')
                    ->limit(5)
                    ->get();
            });

            // Get stats
            $stats = [
                'total' => Agenda::where('status', 'aktif')->count(),
                'upcoming' => Agenda::where('status', 'aktif')
                    ->where('tanggal_mulai', '>=', now())->count(),
                'this_month' => Agenda::where('status', 'aktif')
                    ->whereMonth('tanggal_mulai', now()->month)
                    ->whereYear('tanggal_mulai', now()->year)
                    ->count(),
            ];

            // Handle AJAX requests for section updates
            if ($request->ajax() || $request->has('section_only')) {
                return response()->json([
                    'success' => true,
                    'html' => view('pages.agenda-section', compact('agenda', 'categories'))->render(),
                    'pagination' => [
                        'current_page' => $agenda->currentPage(),
                        'last_page' => $agenda->lastPage(),
                        'total' => $agenda->total(),
                    ]
                ]);
            }

            return view('pages.agenda', compact(
                'agenda',
                'categories',
                'featuredAgenda',
                'upcomingAgenda',
                'stats'
            ));

        } catch (\Exception $e) {
            \Log::error('Error in AgendaController@index: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memuat data'
                ], 500);
            }

            // Fallback data for regular requests
            return view('pages.agenda', [
                'agenda' => collect(),
                'categories' => Agenda::getKategoris(),
                'featuredAgenda' => collect(),
                'upcomingAgenda' => collect(),
                'stats' => ['total' => 0, 'upcoming' => 0, 'this_month' => 0]
            ]);
        }
    }

    /**
     * Display the specified agenda detail - FIXED METHOD
     */
    public function show(Request $request, $slug)
    {
        try {
            // Find agenda by slug - EXPLICIT QUERY
            $agenda = Agenda::where('slug', $slug)
                ->where('status', 'aktif')
                ->with(['creator:id,name'])
                ->first();

            // Check if agenda exists
            if (!$agenda) {
                abort(404, 'Agenda tidak ditemukan');
            }

            // Increment views
            $agenda->increment('views');

            // Get related agenda (same category, exclude current)
            $relatedAgenda = Agenda::where('status', 'aktif')
                ->where('kategori', $agenda->kategori)
                ->where('id', '!=', $agenda->id)
                ->where('tanggal_mulai', '>=', now())
                ->orderBy('tanggal_mulai', 'asc')
                ->limit(4)
                ->get();

            // Get navigation (previous/next)
            $previousAgenda = Agenda::where('status', 'aktif')
                ->where('id', '<', $agenda->id)
                ->orderBy('id', 'desc')
                ->first();

            $nextAgenda = Agenda::where('status', 'aktif')
                ->where('id', '>', $agenda->id)
                ->orderBy('id', 'asc')
                ->first();

            return view('pages.agenda-detail', compact(
                'agenda',
                'relatedAgenda',
                'previousAgenda',
                'nextAgenda'
            ));

        } catch (\Exception $e) {
            \Log::error('Error in AgendaController@show: ' . $e->getMessage());
            abort(404, 'Agenda tidak ditemukan');
        }
    }

    /**
     * Display agenda by kategori
     */
    public function kategori(Request $request, $kategori)
    {
        try {
            $categories = Agenda::getKategoris();

            // Check if kategori exists
            if (!array_key_exists($kategori, $categories)) {
                abort(404, 'Kategori tidak ditemukan.');
            }

            $query = Agenda::where('status', 'aktif')
                ->where('kategori', $kategori)
                ->with(['creator:id,name']);

            // Search functionality
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhere('tempat', 'like', "%{$search}%");
                });
            }

            // Sort options
            $sortBy = $request->get('sort', 'tanggal_mulai');
            switch ($sortBy) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'popular':
                    $query->orderBy('views', 'desc');
                    break;
                case 'priority':
                    $priorities = ['urgent', 'tinggi', 'normal', 'rendah'];
                    $query->orderByRaw("FIELD(prioritas, '" . implode("','", $priorities) . "')");
                    break;
                case 'tanggal_mulai':
                default:
                    $query->orderBy('tanggal_mulai', 'asc');
                    break;
            }

            $agenda = $query->paginate(12)->withQueryString();

            // Get featured agenda for this category
            $featuredAgenda = Cache::remember("featured_agenda_{$kategori}", 300, function () use ($kategori) {
                return Agenda::where('status', 'aktif')
                    ->where('kategori', $kategori)
                    ->where('is_featured', true)
                    ->where('tanggal_mulai', '>=', now())
                    ->orderBy('tanggal_mulai', 'asc')
                    ->limit(3)
                    ->get();
            });

            $kategoriLabel = $categories[$kategori];

            return view('pages.agenda', compact(
                'agenda',
                'categories',
                'featuredAgenda',
                'kategori',
                'kategoriLabel'
            ));

        } catch (\Exception $e) {
            \Log::error('Error in AgendaController@kategori: ' . $e->getMessage());
            abort(404, 'Kategori tidak ditemukan');
        }
    }

    /**
     * Get upcoming agenda for AJAX requests
     */
    public function upcoming(Request $request): JsonResponse
    {
        try {
            $limit = $request->get('limit', 5);
            $exclude = $request->get('exclude');

            $query = Agenda::where('status', 'aktif')
                ->where('tanggal_mulai', '>=', now())
                ->with(['creator:id,name']);

            if ($exclude) {
                $query->where('id', '!=', $exclude);
            }

            $agenda = $query->orderBy('tanggal_mulai', 'asc')
                          ->limit($limit)
                          ->get()
                          ->map(function($item) {
                              return [
                                  'id' => $item->id,
                                  'judul' => $item->judul,
                                  'slug' => $item->slug,
                                  'deskripsi' => \Illuminate\Support\Str::limit($item->deskripsi, 100),
                                  'featured_image_url' => $item->featured_image_url,
                                  'kategori' => $item->kategori,
                                  'kategori_label' => $item->kategori_label,
                                  'prioritas' => $item->prioritas,
                                  'tempat' => $item->tempat,
                                  'tanggal_mulai' => $item->tanggal_mulai->format('Y-m-d H:i:s'),
                                  'formatted_date' => $item->formatted_start_date,
                                  'views' => number_format($item->views),
                                  'penyelenggara' => $item->penyelenggara,
                                  'url' => route('agenda.show', $item->slug),
                              ];
                          });

            return response()->json([
                'status' => 'success',
                'data' => $agenda,
                'total' => $agenda->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data agenda: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search agenda for AJAX requests
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $search = $request->get('q', $request->get('search'));
            $limit = $request->get('limit', 10);

            if (empty($search)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Query pencarian tidak boleh kosong'
                ], 400);
            }

            $query = Agenda::where('status', 'aktif')
                ->with(['creator:id,name'])
                ->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhere('tempat', 'like', "%{$search}%")
                      ->orWhere('penyelenggara', 'like', "%{$search}%");
                });

            $agenda = $query->orderBy('tanggal_mulai', 'asc')
                          ->limit($limit)
                          ->get()
                          ->map(function($item) {
                              return [
                                  'id' => $item->id,
                                  'judul' => $item->judul,
                                  'slug' => $item->slug,
                                  'deskripsi' => \Illuminate\Support\Str::limit($item->deskripsi, 100),
                                  'featured_image_url' => $item->featured_image_url,
                                  'kategori' => $item->kategori,
                                  'kategori_label' => $item->kategori_label,
                                  'tempat' => $item->tempat,
                                  'tanggal_mulai' => $item->tanggal_mulai->format('Y-m-d H:i:s'),
                                  'formatted_date' => $item->formatted_start_date,
                                  'views' => number_format($item->views),
                                  'penyelenggara' => $item->penyelenggara,
                                  'url' => route('agenda.show', $item->slug),
                              ];
                          });

            return response()->json([
                'status' => 'success',
                'data' => $agenda,
                'total' => $agenda->count(),
                'query' => $search
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal melakukan pencarian: ' . $e->getMessage()
            ], 500);
        }
    }
}