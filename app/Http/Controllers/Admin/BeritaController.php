<?php
// app/Http/Controllers/Admin/BeritaController.php - FIXED VERSION (NO IMAGE FEATURES)

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class BeritaController extends Controller
{
    /**
     * Display a listing of berita
     */
    public function index(Request $request)
    {
        try {
            // Get statistics for the header cards
            $stats = [
                'total' => Berita::count(),
                'published' => Berita::where('status', 'published')->count(),
                'draft' => Berita::where('status', 'draft')->count(),
                'bulan_ini' => Berita::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
                'featured' => Berita::where('is_featured', true)
                    ->where('status', 'published')
                    ->count(),
                'archived' => Berita::where('status', 'archived')->count(),
            ];

            return view('admin.berita.index', compact('stats'));

        } catch (\Exception $e) {
            Log::error('Error in BeritaController@index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat halaman berita');
        }
    }

    /**
     * DataTables AJAX response for berita data
     */
    public function datatables(Request $request)
    {
        try {
            $query = Berita::with(['creator:id,name'])->select([
                'id', 'judul', 'slug', 'kategori', 'status', 'views', 
                'is_featured', 'published_at', 'created_by', 'created_at', 'excerpt'
            ]);

            // Apply filters
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            if ($request->filled('kategori')) {
                $query->where('kategori', $request->kategori);
            }
            if ($request->filled('is_featured')) {
                $query->where('is_featured', $request->boolean('is_featured'));
            }
            if ($request->filled('search_global')) {
                $search = $request->search_global;
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('konten', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%");
                });
            }

            return DataTables::of($query)
                ->addColumn('checkbox', function ($berita) {
                    return '<input type="checkbox" class="berita-checkbox" value="' . $berita->id . '">';
                })
                ->editColumn('judul', function ($berita) {
                    $featuredBadge = $berita->is_featured ? 
                        '<span class="badge" style="background: #fef3c7; color: #92400e; margin-left: 6px; font-size: 9px;">⭐</span>' : '';
                    
                    $judul = strlen($berita->judul) > 50 ? substr($berita->judul, 0, 50) . '...' : $berita->judul;
                    $excerpt = $berita->excerpt ? 
                        (strlen($berita->excerpt) > 80 ? substr($berita->excerpt, 0, 80) . '...' : $berita->excerpt) : 
                        'Tidak ada ringkasan';
                    
                    return '
                        <div>
                            <div style="font-weight: 600; color: #111827; margin-bottom: 2px; font-size: 12px;">' . $judul . '</div>
                            <div style="font-size: 10px; color: #6b7280;">' . $excerpt . '</div>
                            ' . $featuredBadge . '
                        </div>
                    ';
                })
                ->editColumn('kategori', function ($berita) {
                    $categories = [
                        'umum' => '📰',
                        'pembangunan' => '🏗️',
                        'kesehatan' => '🏥',
                        'pendidikan' => '📚',
                        'sosial' => '🤝',
                        'ekonomi' => '💰',
                        'lingkungan' => '🌱'
                    ];
                    $icon = $categories[$berita->kategori] ?? '📰';
                    return '<span class="category-badge">' . $icon . ' ' . ucfirst($berita->kategori) . '</span>';
                })
                ->editColumn('status', function ($berita) {
                    $colors = [
                        'draft' => 'bg-yellow-100 text-yellow-800',
                        'published' => 'bg-green-100 text-green-800',
                        'archived' => 'bg-gray-100 text-gray-800'
                    ];
                    $colorClass = $colors[$berita->status] ?? 'bg-gray-100 text-gray-800';
                    return '<span class="px-2 py-1 text-xs rounded-full ' . $colorClass . '">' . ucfirst($berita->status) . '</span>';
                })
                ->editColumn('views', function ($berita) {
                    return '<span class="text-gray-600 font-medium">' . number_format($berita->views) . '</span>';
                })
                ->editColumn('published_at', function ($berita) {
                    if ($berita->published_at) {
                        return '
                            <div>
                                <div style="font-weight: 600; color: #111827; font-size: 11px;">' . $berita->published_at->format('d M Y') . '</div>
                                <div style="font-size: 10px; color: #6b7280;">' . $berita->published_at->format('H:i') . '</div>
                            </div>
                        ';
                    }
                    return '<span class="text-gray-400">-</span>';
                })
                ->addColumn('featured', function ($berita) {
                    $isActive = $berita->is_featured ? 'active' : '';
                    return '
                        <div class="featured-toggle ' . $isActive . '" onclick="toggleFeatured(\'' . $berita->id . '\', ' . ($berita->is_featured ? 'false' : 'true') . ')" title="Toggle Featured">
                        </div>
                    ';
                })
                ->addColumn('author', function ($berita) {
                    return $berita->creator ? $berita->creator->name : 'Unknown';
                })
                ->addColumn('actions', function ($berita) {
                    return '
                        <div class="action-buttons">
                            <a href="' . route('admin.berita.show', $berita->id) . '" class="action-btn btn-view" title="Lihat">👁️</a>
                            <a href="' . route('admin.berita.preview', $berita->id) . '" class="action-btn btn-preview" title="Preview" target="_blank">🔍</a>
                            <a href="' . route('admin.berita.edit', $berita->id) . '" class="action-btn btn-edit" title="Edit">✏️</a>
                            <button onclick="deleteBerita(\'' . $berita->id . '\')" class="action-btn btn-delete" title="Hapus">🗑️</button>
                        </div>
                    ';
                })
                ->rawColumns(['checkbox', 'judul', 'kategori', 'status', 'views', 'published_at', 'featured', 'actions'])
                ->make(true);

        } catch (\Exception $e) {
            Log::error('Error in BeritaController@datatables: ' . $e->getMessage());
            
            return response()->json([
                'draw' => 0,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => 'Terjadi kesalahan saat memuat data'
            ]);
        }
    }

    /**
     * Show the form for creating a new berita
     */
    public function create()
    {
        try {
            $kategoris = $this->getKategoris();
            $statuses = $this->getStatuses();
            
            return view('admin.berita.create', compact('kategoris', 'statuses'));

        } catch (\Exception $e) {
            Log::error('Error in BeritaController@create: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat form tambah berita');
        }
    }

    /**
     * Store a newly created berita
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'kategori' => 'required|in:umum,pembangunan,kesehatan,pendidikan,sosial,ekonomi,lingkungan',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ], [
            'judul.required' => 'Judul wajib diisi',
            'konten.required' => 'Konten wajib diisi',
            'kategori.required' => 'Kategori wajib dipilih',
            'status.required' => 'Status wajib dipilih',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan dalam form');
        }

        try {
            DB::beginTransaction();

            $data = [
                'judul' => $request->judul,
                'slug' => $this->generateUniqueSlug($request->judul),
                'konten' => $request->konten,
                'excerpt' => $request->excerpt ?: Str::limit(strip_tags($request->konten), 200),
                'kategori' => $request->kategori,
                'status' => $request->status,
                'is_featured' => $request->boolean('is_featured'),
                'allow_comments' => $request->boolean('allow_comments'),
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'created_by' => Auth::guard('admin')->id(),
                'updated_by' => Auth::guard('admin')->id(),
                'views' => 0,
            ];

            // Set published_at if status is published
            if ($data['status'] === 'published') {
                $data['published_at'] = $request->published_at ? 
                    Carbon::parse($request->published_at) : 
                    now();
            }

            $berita = Berita::create($data);
            $this->clearCache();
            DB::commit();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil dibuat dengan ID: ' . $berita->id);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating berita: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan berita: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified berita
     */
    public function show($id)
    {
        try {
            $berita = Berita::with(['creator:id,name'])->find($id);
            
            if (!$berita) {
                return back()->with('error', 'Berita tidak ditemukan');
            }
            
            return view('admin.berita.show', compact('berita'));

        } catch (\Exception $e) {
            Log::error('Error in BeritaController@show: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat detail berita');
        }
    }

    /**
     * Show the form for editing berita
     */
    public function edit($id)
    {
        try {
            $berita = Berita::find($id);
            
            if (!$berita) {
                return back()->with('error', 'Berita tidak ditemukan');
            }
            
            $kategoris = $this->getKategoris();
            $statuses = $this->getStatuses();
            
            return view('admin.berita.edit', compact('berita', 'kategoris', 'statuses'));

        } catch (\Exception $e) {
            Log::error('Error in BeritaController@edit: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat form edit berita');
        }
    }

    /**
     * Update the specified berita
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);
        
        if (!$berita) {
            return back()->with('error', 'Berita tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'kategori' => 'required|in:umum,pembangunan,kesehatan,pendidikan,sosial,ekonomi,lingkungan',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan dalam form');
        }

        try {
            DB::beginTransaction();

            $data = [
                'judul' => $request->judul,
                'konten' => $request->konten,
                'excerpt' => $request->excerpt ?: Str::limit(strip_tags($request->konten), 200),
                'kategori' => $request->kategori,
                'status' => $request->status,
                'is_featured' => $request->boolean('is_featured'),
                'allow_comments' => $request->boolean('allow_comments'),
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'updated_by' => Auth::guard('admin')->id(),
            ];

            // Update slug if title changed
            if ($berita->judul !== $request->judul) {
                $data['slug'] = $this->generateUniqueSlug($request->judul, $berita->id);
            }

            // Handle published_at
            if ($data['status'] === 'published' && !$berita->published_at) {
                $data['published_at'] = $request->published_at ? 
                    Carbon::parse($request->published_at) : 
                    now();
            } elseif ($data['status'] !== 'published') {
                $data['published_at'] = null;
            }

            $berita->update($data);
            $this->clearCache();
            DB::commit();

            return redirect()->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating berita: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui berita: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified berita
     */
    public function destroy($id)
    {
        try {
            $berita = Berita::find($id);
            
            if (!$berita) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Berita tidak ditemukan'
                ], 404);
            }

            DB::beginTransaction();

            $berita->delete();
            $this->clearCache();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting berita: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Preview berita
     */
    public function preview($id)
    {
        try {
            $berita = Berita::with(['creator:id,name'])->find($id);
            
            if (!$berita) {
                return back()->with('error', 'Berita tidak ditemukan');
            }
            
            return view('admin.berita.preview', compact('berita'));

        } catch (\Exception $e) {
            Log::error('Error in BeritaController@preview: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat preview berita');
        }
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Request $request, $id)
    {
        try {
            $berita = Berita::find($id);
            
            if (!$berita) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Berita tidak ditemukan'
                ], 404);
            }

            $berita->update([
                'is_featured' => $request->boolean('featured'),
                'updated_by' => Auth::guard('admin')->id(),
            ]);

            $this->clearCache();

            return response()->json([
                'status' => 'success',
                'message' => 'Status featured berhasil diperbarui!',
                'is_featured' => $berita->is_featured
            ]);

        } catch (\Exception $e) {
            Log::error('Error toggling featured status: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui status featured'
            ], 500);
        }
    }

    /**
     * Update status berita
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:draft,published,archived'
        ]);

        try {
            $berita = Berita::find($id);
            
            if (!$berita) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Berita tidak ditemukan'
                ], 404);
            }

            $data = ['status' => $request->status, 'updated_by' => Auth::guard('admin')->id()];
            
            // Set published_at if changing to published
            if ($request->status === 'published' && !$berita->published_at) {
                $data['published_at'] = now();
            } elseif ($request->status !== 'published') {
                $data['published_at'] = null;
            }

            $berita->update($data);
            $this->clearCache();

            return response()->json([
                'status' => 'success',
                'message' => 'Status berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating berita status: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,draft,archive',
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:berita,id'
        ]);

        try {
            DB::beginTransaction();

            $ids = $request->selected_ids;
            $action = $request->action;
            $updatedBy = Auth::guard('admin')->id();

            switch ($action) {
                case 'delete':
                    Berita::whereIn('id', $ids)->delete();
                    $message = count($ids) . ' berita berhasil dihapus!';
                    break;

                case 'publish':
                    Berita::whereIn('id', $ids)->update([
                        'status' => 'published',
                        'published_at' => now(),
                        'updated_by' => $updatedBy
                    ]);
                    $message = count($ids) . ' berita berhasil dipublish!';
                    break;

                case 'draft':
                    Berita::whereIn('id', $ids)->update([
                        'status' => 'draft',
                        'published_at' => null,
                        'updated_by' => $updatedBy
                    ]);
                    $message = count($ids) . ' berita berhasil dijadikan draft!';
                    break;

                case 'archive':
                    Berita::whereIn('id', $ids)->update([
                        'status' => 'archived',
                        'updated_by' => $updatedBy
                    ]);
                    $message = count($ids) . ' berita berhasil diarsipkan!';
                    break;
            }

            $this->clearCache();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => $message
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in bulk action: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate unique slug
     */
    private function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        $query = Berita::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
            
            if ($counter > 1000) {
                $slug = $originalSlug . '-' . time() . '-' . rand(100, 999);
                break;
            }
            
            $query = Berita::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    /**
     * Clear related cache
     */
    private function clearCache()
    {
        Cache::forget('home_featured_news');
        Cache::forget('home_latest_news');
        Cache::forget('sidebar_featured_news');
        Cache::forget('sidebar_latest_news');
        Cache::forget('home_statistics');
        Cache::forget('admin_dashboard_stats');
        
        $categories = ['umum', 'pembangunan', 'kesehatan', 'pendidikan', 'sosial', 'ekonomi', 'lingkungan'];
        foreach ($categories as $category) {
            Cache::forget("featured_berita_{$category}");
        }
    }

    /**
     * Get available categories
     */
    private function getKategoris()
    {
        return Berita::getKategoris();
    }

    /**
     * Get available statuses
     */
    private function getStatuses()
    {
        return Berita::getStatuses();
    }
}