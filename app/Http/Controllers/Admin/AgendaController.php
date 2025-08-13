<?php
// app/Http/Controllers/Admin/AgendaController.php - FIXED VERSION

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AgendaController extends Controller
{
    /**
     * Display a listing of agenda
     */
    public function index(Request $request)
    {
        try {
            // REMOVED: if ($request->ajax()) return $this->datatables($request);
            // FIXED: Handle AJAX requests in separate data() method

            $stats = [
                'total_agenda' => Agenda::count(),
                'agenda_aktif' => Agenda::where('status', 'aktif')->count(),
                'agenda_nonaktif' => Agenda::where('status', 'nonaktif')->count(),
                'agenda_mendatang' => Agenda::where('tanggal_mulai', '>=', now())->count(),
                'agenda_urgent' => Agenda::where('prioritas', 'urgent')
                    ->where('status', 'aktif')
                    ->where('tanggal_mulai', '>=', now())
                    ->count(),
                'agenda_selesai' => Agenda::where('status', 'selesai')
                    ->whereMonth('tanggal_mulai', now()->month)
                    ->whereYear('tanggal_mulai', now()->year)
                    ->count(),
            ];

            return view('admin.agenda.index', compact('stats'));

        } catch (\Exception $e) {
            Log::error('Error in AgendaController@index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat halaman agenda');
        }
    }

    /**
     * DataTables AJAX response for agenda data - FIXED METHOD NAME
     */
    public function data(Request $request)
    {
        try {
            $query = Agenda::query();

            // Apply filters
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            if ($request->filled('kategori')) {
                $query->where('kategori', $request->kategori);
            }
            if ($request->filled('prioritas')) {
                $query->where('prioritas', $request->prioritas);
            }
            if ($request->filled('periode')) {
                switch ($request->periode) {
                    case 'hari_ini':
                        $query->whereDate('tanggal_mulai', now()->toDateString());
                        break;
                    case 'minggu_ini':
                        $query->whereBetween('tanggal_mulai', [
                            now()->startOfWeek(),
                            now()->endOfWeek()
                        ]);
                        break;
                    case 'bulan_ini':
                        $query->whereMonth('tanggal_mulai', now()->month)
                              ->whereYear('tanggal_mulai', now()->year);
                        break;
                    case 'mendatang':
                        $query->where('tanggal_mulai', '>', now());
                        break;
                }
            }
            if ($request->filled('tanggal_mulai')) {
                $query->where('tanggal_mulai', '>=', $request->tanggal_mulai);
            }
            if ($request->filled('tanggal_selesai')) {
                $query->where('tanggal_mulai', '<=', $request->tanggal_selesai);
            }
            if ($request->filled('search_global')) {
                $search = $request->search_global;
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhere('tempat', 'like', "%{$search}%")
                      ->orWhere('penyelenggara', 'like', "%{$search}%");
                });
            }

            return DataTables::of($query)
                ->addColumn('checkbox', function ($agenda) {
                    return '<input type="checkbox" class="agenda-checkbox" value="' . $agenda->id . '">';
                })
                ->editColumn('judul', function ($agenda) {
                    $featuredBadge = $agenda->is_featured ? 
                        '<span class="badge" style="background: #fef3c7; color: #92400e; margin-left: 6px; font-size: 9px;">⭐</span>' : '';
                    
                    $image = $agenda->featured_image ? 
                        '<img src="' . Storage::url('agenda/' . $agenda->featured_image) . '" style="width: 32px; height: 32px; object-fit: cover; border-radius: 4px; margin-right: 8px;">' : 
                        '<div style="width: 32px; height: 32px; background: #f3f4f6; border-radius: 4px; margin-right: 8px; display: flex; align-items: center; justify-content: center; font-size: 12px;">📅</div>';
                    
                    $judul = strlen($agenda->judul) > 40 ? substr($agenda->judul, 0, 40) . '...' : $agenda->judul;
                    $deskripsi = $agenda->deskripsi ? 
                        (strlen($agenda->deskripsi) > 50 ? substr($agenda->deskripsi, 0, 50) . '...' : $agenda->deskripsi) : 
                        'Tidak ada deskripsi';
                    
                    return '
                        <div style="display: flex; align-items: center;">
                            ' . $image . '
                            <div>
                                <div style="font-weight: 600; color: #111827; margin-bottom: 2px; font-size: 12px;">' . $judul . '</div>
                                <div style="font-size: 10px; color: #6b7280;">' . $deskripsi . '</div>
                                ' . $featuredBadge . '
                            </div>
                        </div>
                    ';
                })
                ->editColumn('kategori', function ($agenda) {
                    $categories = [
                        'rapat' => '👥',
                        'kegiatan' => '🎉',
                        'sosialisasi' => '📢',
                        'gotong_royong' => '🤝',
                        'pelatihan' => '📚',
                        'upacara' => '🏛️',
                        'lainnya' => '📋'
                    ];
                    $icon = $categories[$agenda->kategori] ?? '📋';
                    return '<span class="category-badge">' . $icon . ' ' . $agenda->kategori . '</span>';
                })
                ->editColumn('tanggal_mulai', function ($agenda) {
                    $dateStr = $agenda->tanggal_mulai->format('d M Y');
                    
                    $timeStr = '';
                    if ($agenda->waktu_mulai) {
                        $timeStr = $agenda->waktu_mulai;
                        if ($agenda->waktu_selesai) {
                            $timeStr .= ' - ' . $agenda->waktu_selesai;
                        }
                    }
                    
                    return '
                        <div>
                            <div style="font-weight: 600; color: #111827; font-size: 11px;">' . $dateStr . '</div>
                            ' . ($timeStr ? '<div style="font-size: 10px; color: #6b7280;">🕐 ' . $timeStr . '</div>' : '') . '
                        </div>
                    ';
                })
                ->editColumn('tempat', function ($agenda) {
                    $tempat = strlen($agenda->tempat) > 20 ? substr($agenda->tempat, 0, 20) . '...' : $agenda->tempat;
                    $alamat = $agenda->alamat_lengkap ? 
                        (strlen($agenda->alamat_lengkap) > 25 ? substr($agenda->alamat_lengkap, 0, 25) . '...' : $agenda->alamat_lengkap) : 
                        '';
                    
                    return '
                        <div>
                            <div style="font-weight: 600; color: #111827; font-size: 11px;">📍 ' . $tempat . '</div>
                            ' . ($alamat ? '<div style="font-size: 10px; color: #6b7280;">' . $alamat . '</div>' : '') . '
                        </div>
                    ';
                })
                ->editColumn('status', function ($agenda) {
                    return '<span class="badge badge-' . $agenda->status . '">' . ucfirst($agenda->status) . '</span>';
                })
                ->editColumn('prioritas', function ($agenda) {
                    $priorities = [
                        'rendah' => '🟢',
                        'normal' => '🔵',
                        'tinggi' => '🟡',
                        'urgent' => '🔴'
                    ];
                    $icon = $priorities[$agenda->prioritas] ?? '🔵';
                    return '<span class="badge priority-' . $agenda->prioritas . '">' . $icon . ' ' . ucfirst($agenda->prioritas) . '</span>';
                })
                ->addColumn('featured', function ($agenda) {
                    $isActive = $agenda->is_featured ? 'active' : '';
                    return '
                        <div class="featured-toggle ' . $isActive . '" onclick="toggleFeatured(\'' . $agenda->id . '\', ' . ($agenda->is_featured ? 'false' : 'true') . ')" title="Toggle Featured">
                        </div>
                    ';
                })
                ->addColumn('peserta', function ($agenda) {
                    if (!$agenda->perlu_pendaftaran) {
                        return '<span style="color: #6b7280; font-size: 10px;">Tidak ada</span>';
                    }
                    
                    $registered = $agenda->jumlah_pendaftar ?: 0;
                    $capacity = $agenda->kapasitas_peserta ?: 0;
                    $percentage = $capacity > 0 ? round(($registered / $capacity) * 100) : 0;
                    
                    return '
                        <div>
                            <div style="font-weight: 600; color: #111827; font-size: 11px;">' . $registered . '/' . $capacity . '</div>
                            <div style="font-size: 9px; color: #6b7280;">' . $percentage . '% terisi</div>
                        </div>
                    ';
                })
                ->addColumn('actions', function ($agenda) {
                    return '
                        <div class="action-buttons">
                            <a href="' . route('admin.agenda.show', $agenda->id) . '" class="action-btn btn-view" title="Lihat">👁️</a>
                            <a href="' . route('admin.agenda.edit', $agenda->id) . '" class="action-btn btn-edit" title="Edit">✏️</a>
                            <button onclick="deleteAgenda(\'' . $agenda->id . '\')" class="action-btn btn-delete" title="Hapus">🗑️</button>
                        </div>
                    ';
                })
                ->rawColumns(['checkbox', 'judul', 'kategori', 'tanggal_mulai', 'tempat', 'status', 'prioritas', 'featured', 'peserta', 'actions'])
                ->make(true);

        } catch (\Exception $e) {
            Log::error('Error in AgendaController@data: ' . $e->getMessage());
            
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
     * Show the form for creating a new agenda
     */
    public function create()
    {
        try {
            $kategoris = $this->getKategoris();
            $statuses = $this->getStatuses();
            $prioritas = $this->getPrioritas();
            
            return view('admin.agenda.create', compact('kategoris', 'statuses', 'prioritas'));

        } catch (\Exception $e) {
            Log::error('Error in AgendaController@create: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat form tambah agenda');
        }
    }

    /**
     * Store a newly created agenda
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'kategori' => 'required|in:rapat,kegiatan,sosialisasi,gotong_royong,pelatihan,upacara,lainnya',
            'status' => 'required|in:aktif,nonaktif,selesai,dibatalkan',
            'prioritas' => 'required|in:rendah,normal,tinggi,urgent',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'tempat' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan dalam form');
        }

        try {
            DB::beginTransaction();

            $baseSlug = Str::slug($request->judul);
            $uniqueSuffix = substr(Str::uuid()->toString(), 0, 8);
            $uniqueSlug = $baseSlug . '-' . $uniqueSuffix;

            $data = [
                'judul' => $request->judul,
                'slug' => $uniqueSlug,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'status' => $request->status,
                'prioritas' => $request->prioritas,
                'tempat' => $request->tempat,
                'penyelenggara' => $request->penyelenggara,
                'tanggal_mulai' => Carbon::parse($request->tanggal_mulai),
                'tanggal_selesai' => $request->tanggal_selesai ? Carbon::parse($request->tanggal_selesai) : null,
                'created_by' => Auth::guard('admin')->id(),
                'updated_by' => Auth::guard('admin')->id(),
                'views' => 0,
                'jumlah_pendaftar' => 0,
                'perlu_pendaftaran' => false,
                'is_featured' => false,
            ];

            $agenda = Agenda::create($data);
            $this->clearCache();
            DB::commit();

            return redirect()->route('admin.agenda.index')
                ->with('success', 'Agenda berhasil dibuat dengan ID: ' . $agenda->id);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating agenda: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan agenda: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified agenda
     */
    public function show($id)
    {
        try {
            $agenda = Agenda::find($id);
            
            if (!$agenda) {
                return back()->with('error', 'Agenda tidak ditemukan');
            }
            
            return view('admin.agenda.show', compact('agenda'));

        } catch (\Exception $e) {
            Log::error('Error in AgendaController@show: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat detail agenda');
        }
    }

    /**
     * Show the form for editing agenda
     */
    public function edit($id)
    {
        try {
            $agenda = Agenda::find($id);
            
            if (!$agenda) {
                return back()->with('error', 'Agenda tidak ditemukan');
            }
            
            $kategoris = $this->getKategoris();
            $statuses = $this->getStatuses();
            $prioritas = $this->getPrioritas();
            
            return view('admin.agenda.edit', compact('agenda', 'kategoris', 'statuses', 'prioritas'));

        } catch (\Exception $e) {
            Log::error('Error in AgendaController@edit: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat form edit agenda');
        }
    }

    /**
     * Update the specified agenda
     */
    public function update(Request $request, $id)
    {
        $agenda = Agenda::find($id);
        
        if (!$agenda) {
            return back()->with('error', 'Agenda tidak ditemukan');
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'kategori' => 'required|in:rapat,kegiatan,sosialisasi,gotong_royong,pelatihan,upacara,lainnya',
            'status' => 'required|in:aktif,nonaktif,selesai,dibatalkan',
            'prioritas' => 'required|in:rendah,normal,tinggi,urgent',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'tempat' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
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
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'status' => $request->status,
                'prioritas' => $request->prioritas,
                'tempat' => $request->tempat,
                'penyelenggara' => $request->penyelenggara,
                'tanggal_mulai' => Carbon::parse($request->tanggal_mulai),
                'tanggal_selesai' => $request->tanggal_selesai ? Carbon::parse($request->tanggal_selesai) : null,
                'updated_by' => Auth::guard('admin')->id(),
            ];

            if ($agenda->judul !== $request->judul) {
                $data['slug'] = $this->generateUniqueSlug($request->judul, $agenda->id);
            }

            $agenda->update($data);
            $this->clearCache();
            DB::commit();

            return redirect()->route('admin.agenda.index')
                ->with('success', 'Agenda berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating agenda: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui agenda: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified agenda
     */
    public function destroy($id)
    {
        try {
            $agenda = Agenda::find($id);
            
            if (!$agenda) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Agenda tidak ditemukan'
                ], 404);
            }

            DB::beginTransaction();

            if ($agenda->featured_image) {
                Storage::disk('public')->delete('agenda/' . $agenda->featured_image);
            }

            $agenda->delete();
            $this->clearCache();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Agenda berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting agenda: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus agenda: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Request $request, $id)
    {
        try {
            $agenda = Agenda::find($id);
            
            if (!$agenda) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Agenda tidak ditemukan'
                ], 404);
            }

            $agenda->update([
                'is_featured' => $request->boolean('featured'),
                'updated_by' => Auth::guard('admin')->id(),
            ]);

            $this->clearCache();

            return response()->json([
                'status' => 'success',
                'message' => 'Status featured berhasil diperbarui!',
                'is_featured' => $agenda->is_featured
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
     * Bulk actions for status update
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:agenda,id',
            'status' => 'required|in:aktif,nonaktif,selesai,dibatalkan'
        ]);

        try {
            DB::beginTransaction();

            Agenda::whereIn('id', $request->ids)->update([
                'status' => $request->status,
                'updated_by' => Auth::guard('admin')->id(),
            ]);

            $this->clearCache();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => count($request->ids) . ' agenda berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in bulk update status: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    /**
     * Bulk delete agendas
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:agenda,id'
        ]);

        try {
            DB::beginTransaction();

            $agendaList = Agenda::whereIn('id', $request->ids)->get();
            foreach ($agendaList as $agenda) {
                if ($agenda->featured_image) {
                    Storage::disk('public')->delete('agenda/' . $agenda->featured_image);
                }
            }

            Agenda::whereIn('id', $request->ids)->delete();
            $this->clearCache();
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => count($request->ids) . ' agenda berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in bulk delete: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    /**
     * Bulk export agendas
     */
    public function bulkExport(Request $request)
    {
        try {
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'exists:agenda,id'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Export akan segera dimulai...'
            ]);

        } catch (\Exception $e) {
            Log::error('Error in bulk export: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    /**
     * Export all agendas
     */
    public function export(Request $request)
    {
        try {
            return response()->json([
                'status' => 'success',
                'message' => 'Export akan segera dimulai...'
            ]);

        } catch (\Exception $e) {
            Log::error('Error in export: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    /**
     * Calendar view
     */
    public function calendar()
    {
        try {
            return view('admin.agenda.calendar');

        } catch (\Exception $e) {
            Log::error('Error in AgendaController@calendar: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat kalender agenda');
        }
    }

    /**
     * Calendar data for FullCalendar
     */
    public function calendarData(Request $request)
    {
        try {
            $start = $request->get('start');
            $end = $request->get('end');

            $query = Agenda::query();

            if ($start) {
                $query->where('tanggal_mulai', '>=', Carbon::parse($start));
            }

            if ($end) {
                $query->where('tanggal_mulai', '<=', Carbon::parse($end));
            }

            $agendas = $query->get();

            $events = $agendas->map(function ($agenda) {
                $colors = [
                    'urgent' => '#EF4444',
                    'tinggi' => '#F97316', 
                    'normal' => '#3B82F6',
                    'rendah' => '#6B7280'
                ];

                return [
                    'id' => $agenda->id,
                    'title' => $agenda->judul,
                    'start' => $agenda->tanggal_mulai->toISOString(),
                    'end' => $agenda->tanggal_selesai ? $agenda->tanggal_selesai->toISOString() : null,
                    'url' => route('admin.agenda.edit', $agenda->id),
                    'backgroundColor' => $colors[$agenda->prioritas] ?? '#3B82F6',
                    'borderColor' => $colors[$agenda->prioritas] ?? '#3B82F6',
                    'textColor' => '#FFFFFF',
                    'extendedProps' => [
                        'description' => $agenda->deskripsi,
                        'location' => $agenda->tempat,
                        'organizer' => $agenda->penyelenggara,
                        'priority' => $agenda->prioritas,
                        'status' => $agenda->status,
                        'category' => $agenda->kategori,
                    ]
                ];
            });

            return response()->json($events);

        } catch (\Exception $e) {
            Log::error('Error getting calendar data: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Gagal mengambil data kalender'
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

        $query = Agenda::where('slug', $slug);
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
            
            $query = Agenda::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    /**
     * Clear related caches
     */
    private function clearCache()
    {
        Cache::forget('home_upcoming_agenda');
        Cache::forget('sidebar_upcoming_agenda');
        Cache::forget('sidebar_featured_agenda');
        Cache::forget('home_statistics');
        Cache::forget('admin_dashboard_stats');
        
        $categories = ['rapat', 'kegiatan', 'sosialisasi', 'gotong_royong', 'pelatihan', 'upacara', 'lainnya'];
        foreach ($categories as $category) {
            Cache::forget("featured_agenda_{$category}");
        }
    }

    /**
     * Get available categories
     */
    private function getKategoris()
    {
        return [
            'rapat' => 'Rapat',
            'kegiatan' => 'Kegiatan',
            'sosialisasi' => 'Sosialisasi',
            'gotong_royong' => 'Gotong Royong',
            'pelatihan' => 'Pelatihan',
            'upacara' => 'Upacara',
            'lainnya' => 'Lainnya'
        ];
    }

    /**
     * Get available statuses
     */
    private function getStatuses()
    {
        return [
            'aktif' => 'Aktif',
            'nonaktif' => 'Non Aktif',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan'
        ];
    }

    /**
     * Get available priorities
     */
    private function getPrioritas()
    {
        return [
            'rendah' => 'Rendah',
            'normal' => 'Normal',
            'tinggi' => 'Tinggi',
            'urgent' => 'Urgent'
        ];
    }
}