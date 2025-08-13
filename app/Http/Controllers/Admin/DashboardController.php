<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        try {
            // Get basic statistics
            $stats = $this->getBasicStats();
            
            // Get recent activities
            $recentActivities = $this->getRecentActivities();
            
            // Get pending items that need attention
            $pendingItems = $this->getPendingItems();

            // Get chart data for dashboard graphs
            $chartData = $this->getChartData();

            return view('admin.dashboard', compact(
                'stats', 
                'recentActivities', 
                'pendingItems',
                'chartData'
            ));

        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            
            // Return dashboard with empty data in case of error
            return view('admin.dashboard', [
                'stats' => $this->getEmptyStats(),
                'recentActivities' => collect(),
                'pendingItems' => [],
                'chartData' => []
            ]);
        }
    }

    /**
     * Get basic statistics for dashboard
     */
    private function getBasicStats(): array
    {
        return Cache::remember('admin_dashboard_stats', 300, function () {
            $currentMonth = now()->month;
            $currentYear = now()->year;

            return [
                // Berita Statistics
                'total_berita' => Berita::count(),
                'berita_published' => Berita::where('status', 'published')->count(),
                'berita_draft' => Berita::where('status', 'draft')->count(),
                'berita_archived' => Berita::where('status', 'archived')->count(),
                'berita_featured' => Berita::where('is_featured', true)->count(),
                'berita_bulan_ini' => Berita::whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count(),
                'total_views' => Berita::sum('views'),
                
                // Agenda Statistics
                'total_agenda' => Agenda::count(),
                'agenda_aktif' => Agenda::where('status', 'aktif')->count(),
                'agenda_nonaktif' => Agenda::where('status', 'nonaktif')->count(),
                'agenda_selesai' => Agenda::where('status', 'selesai')->count(),
                'agenda_mendatang' => Agenda::where('tanggal_mulai', '>=', now())->count(),
                'agenda_hari_ini' => Agenda::whereDate('tanggal_mulai', today())->count(),
                'agenda_minggu_ini' => Agenda::whereBetween('tanggal_mulai', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ])->count(),
                'agenda_bulan_ini' => Agenda::whereMonth('tanggal_mulai', $currentMonth)
                    ->whereYear('tanggal_mulai', $currentYear)
                    ->count(),
                'agenda_urgent' => Agenda::where('prioritas', 'urgent')
                    ->where('status', 'aktif')
                    ->where('tanggal_mulai', '>=', now())
                    ->count(),
                
                // Admin Statistics
                'total_admin' => Admin::count(),
                'admin_aktif' => Admin::where('is_active', true)->count(),
                'admin_login_hari_ini' => Admin::whereDate('last_login_at', today())->count(),
            ];
        });
    }

    /**
     * Get empty stats in case of error
     */
    private function getEmptyStats(): array
    {
        return [
            'total_berita' => 0,
            'berita_published' => 0,
            'berita_draft' => 0,
            'berita_archived' => 0,
            'berita_featured' => 0,
            'berita_bulan_ini' => 0,
            'total_views' => 0,
            'total_agenda' => 0,
            'agenda_aktif' => 0,
            'agenda_nonaktif' => 0,
            'agenda_selesai' => 0,
            'agenda_mendatang' => 0,
            'agenda_hari_ini' => 0,
            'agenda_minggu_ini' => 0,
            'agenda_bulan_ini' => 0,
            'agenda_urgent' => 0,
            'total_admin' => 0,
            'admin_aktif' => 0,
            'admin_login_hari_ini' => 0,
        ];
    }

    /**
     * Get recent activities for dashboard
     */
    private function getRecentActivities()
    {
        try {
            // Recent berita
            $recentBerita = Berita::latest()
                ->take(4)
                ->select('id', 'judul', 'slug', 'status', 'views', 'created_at', 'created_by')
                ->with('creator:id,name')
                ->get()
                ->map(function ($berita) {
                    return [
                        'type' => 'berita',
                        'icon' => 'news',
                        'title' => 'Berita: ' . \Illuminate\Support\Str::limit($berita->judul, 50),
                        'description' => 'Status: ' . ucfirst($berita->status) . ' • Views: ' . number_format($berita->views),
                        'time' => $berita->created_at,
                        'user' => $berita->creator->name ?? 'Unknown',
                        'url' => route('admin.berita.edit', $berita->id),
                        'status' => $berita->status,
                        'color' => $berita->status === 'published' ? 'green' : ($berita->status === 'draft' ? 'yellow' : 'gray')
                    ];
                });

            // Recent agenda
            $recentAgenda = Agenda::latest()
                ->take(4)
                ->select('id', 'judul', 'slug', 'status', 'prioritas', 'tanggal_mulai', 'views', 'created_at', 'created_by')
                ->with('creator:id,name')
                ->get()
                ->map(function ($agenda) {
                    return [
                        'type' => 'agenda',
                        'icon' => 'calendar',
                        'title' => 'Agenda: ' . \Illuminate\Support\Str::limit($agenda->judul, 50),
                        'description' => 'Tanggal: ' . $agenda->tanggal_mulai->format('d M Y') . ' • ' . ucfirst($agenda->prioritas),
                        'time' => $agenda->created_at,
                        'user' => $agenda->creator->name ?? 'Unknown',
                        'url' => route('admin.agenda.edit', $agenda->id),
                        'status' => $agenda->status,
                        'color' => $agenda->status === 'aktif' ? 'green' : 'gray',
                        'priority_color' => $agenda->prioritas === 'urgent' ? 'red' : ($agenda->prioritas === 'tinggi' ? 'orange' : 'blue')
                    ];
                });

            // Combine and sort by time
            $activities = collect()
                ->merge($recentBerita)
                ->merge($recentAgenda)
                ->sortByDesc('time')
                ->take(10)
                ->values();

            return $activities;

        } catch (\Exception $e) {
            Log::error('Error getting recent activities: ' . $e->getMessage());
            return collect();
        }
    }

    /**
     * Get pending items that need attention
     */
    private function getPendingItems(): array
    {
        try {
            return [
                'berita_draft' => Berita::where('status', 'draft')
                    ->latest()
                    ->take(5)
                    ->select('id', 'judul', 'slug', 'created_at', 'created_by')
                    ->with('creator:id,name')
                    ->get()
                    ->map(function($berita) {
                        return [
                            'title' => $berita->judul,
                            'url' => route('admin.berita.edit', $berita->id),
                            'time' => $berita->created_at->diffForHumans(),
                            'author' => $berita->creator->name ?? 'Unknown'
                        ];
                    }),
                
                'agenda_mendatang' => Agenda::where('tanggal_mulai', '>=', now())
                    ->where('tanggal_mulai', '<=', now()->addWeeks(2))
                    ->where('status', 'aktif')
                    ->orderBy('tanggal_mulai')
                    ->take(5)
                    ->select('id', 'judul', 'slug', 'tanggal_mulai', 'prioritas', 'tempat')
                    ->get()
                    ->map(function($agenda) {
                        return [
                            'title' => $agenda->judul,
                            'url' => route('admin.agenda.edit', $agenda->id),
                            'date' => $agenda->tanggal_mulai->format('d M Y H:i'),
                            'location' => $agenda->tempat,
                            'priority' => $agenda->prioritas,
                            'days_until' => $agenda->tanggal_mulai->diffInDays(now())
                        ];
                    }),

                'agenda_urgent' => Agenda::where('prioritas', 'urgent')
                    ->where('status', 'aktif')
                    ->where('tanggal_mulai', '>=', now())
                    ->orderBy('tanggal_mulai')
                    ->take(3)
                    ->select('id', 'judul', 'slug', 'tanggal_mulai', 'tempat')
                    ->get()
                    ->map(function($agenda) {
                        return [
                            'title' => $agenda->judul,
                            'url' => route('admin.agenda.edit', $agenda->id),
                            'date' => $agenda->tanggal_mulai->format('d M Y H:i'),
                            'location' => $agenda->tempat,
                            'time_until' => $agenda->tanggal_mulai->diffForHumans()
                        ];
                    }),
            ];

        } catch (\Exception $e) {
            Log::error('Error getting pending items: ' . $e->getMessage());
            return [
                'berita_draft' => collect(),
                'agenda_mendatang' => collect(),
                'agenda_urgent' => collect(),
            ];
        }
    }

    /**
     * Get chart data for dashboard graphs
     */
    private function getChartData(): array
    {
        try {
            // Monthly content creation for the last 6 months
            $monthlyData = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthlyData[] = [
                    'month' => $date->format('M'),
                    'berita' => Berita::whereMonth('created_at', $date->month)
                        ->whereYear('created_at', $date->year)
                        ->count(),
                    'agenda' => Agenda::whereMonth('created_at', $date->month)
                        ->whereYear('created_at', $date->year)
                        ->count(),
                ];
            }

            // Category distribution for berita
            $beritaCategories = Berita::selectRaw('kategori, COUNT(*) as count')
                ->where('status', 'published')
                ->groupBy('kategori')
                ->orderBy('count', 'desc')
                ->get()
                ->map(function($item) {
                    return [
                        'name' => ucfirst(str_replace('-', ' ', $item->kategori)),
                        'value' => $item->count
                    ];
                });

            // Category distribution for agenda
            $agendaCategories = Agenda::selectRaw('kategori, COUNT(*) as count')
                ->where('status', 'aktif')
                ->groupBy('kategori')
                ->orderBy('count', 'desc')
                ->get()
                ->map(function($item) {
                    return [
                        'name' => ucfirst(str_replace('_', ' ', $item->kategori)),
                        'value' => $item->count
                    ];
                });

            return [
                'monthly' => $monthlyData,
                'berita_categories' => $beritaCategories,
                'agenda_categories' => $agendaCategories,
            ];

        } catch (\Exception $e) {
            Log::error('Error getting chart data: ' . $e->getMessage());
            return [
                'monthly' => [],
                'berita_categories' => [],
                'agenda_categories' => [],
            ];
        }
    }

    /**
     * API: Get statistics for AJAX requests
     */
    public function statistics(): JsonResponse
    {
        try {
            $stats = $this->getBasicStats();
            
            return response()->json([
                'status' => 'success',
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting statistics: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil statistik',
                'data' => $this->getEmptyStats()
            ], 500);
        }
    }

    /**
     * API: Get recent activities for AJAX requests
     */
    public function activities(): JsonResponse
    {
        try {
            $activities = $this->getRecentActivities();
            
            return response()->json([
                'status' => 'success',
                'data' => $activities
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting activities: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil aktivitas terbaru',
                'data' => []
            ], 500);
        }
    }

    /**
     * API: Get notifications
     */
    public function notifications(): JsonResponse
    {
        try {
            $notifications = [];

            // Check for draft berita
            $draftCount = Berita::where('status', 'draft')->count();
            if ($draftCount > 0) {
                $notifications[] = [
                    'id' => 'draft_berita',
                    'title' => 'Berita Draft',
                    'message' => "{$draftCount} berita draft perlu ditinjau",
                    'type' => 'info',
                    'time' => now(),
                    'read' => false,
                    'url' => route('admin.berita.index', ['status' => 'draft']),
                    'icon' => 'document-text'
                ];
            }

            // Check for urgent agenda
            $urgentCount = Agenda::where('prioritas', 'urgent')
                ->where('status', 'aktif')
                ->where('tanggal_mulai', '>=', now())
                ->where('tanggal_mulai', '<=', now()->addDays(3))
                ->count();
            
            if ($urgentCount > 0) {
                $notifications[] = [
                    'id' => 'urgent_agenda',
                    'title' => 'Agenda Urgent',
                    'message' => "{$urgentCount} agenda urgent dalam 3 hari ke depan",
                    'type' => 'warning',
                    'time' => now()->subMinutes(30),
                    'read' => false,
                    'url' => route('admin.agenda.index', ['prioritas' => 'urgent']),
                    'icon' => 'exclamation'
                ];
            }

            // Check for today's agenda
            $todayCount = Agenda::whereDate('tanggal_mulai', today())
                ->where('status', 'aktif')
                ->count();
            
            if ($todayCount > 0) {
                $notifications[] = [
                    'id' => 'today_agenda',
                    'title' => 'Agenda Hari Ini',
                    'message' => "{$todayCount} agenda terjadwal hari ini",
                    'type' => 'info',
                    'time' => now()->subHours(1),
                    'read' => false,
                    'url' => route('admin.agenda.index', ['tanggal' => 'hari-ini']),
                    'icon' => 'calendar'
                ];
            }

            return response()->json([
                'status' => 'success',
                'data' => $notifications,
                'unread_count' => count($notifications)
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting notifications: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil notifikasi',
                'data' => [],
                'unread_count' => 0
            ], 500);
        }
    }

    /**
     * API: Get quick stats for real-time updates
     */
    public function quickStats(): JsonResponse
    {
        try {
            $quickStats = [
                'berita_draft' => Berita::where('status', 'draft')->count(),
                'agenda_hari_ini' => Agenda::whereDate('tanggal_mulai', today())
                    ->where('status', 'aktif')
                    ->count(),
                'agenda_urgent' => Agenda::where('prioritas', 'urgent')
                    ->where('status', 'aktif')
                    ->where('tanggal_mulai', '>=', now())
                    ->count(),
                'berita_views_hari_ini' => Berita::where('status', 'published')
                    ->whereDate('updated_at', today())
                    ->sum('views'),
                'admin_online' => Admin::where('last_login_at', '>=', now()->subMinutes(30))
                    ->where('is_active', true)
                    ->count(),
            ];

            return response()->json([
                'status' => 'success',
                'data' => $quickStats
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting quick stats: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil statistik cepat',
                'data' => []
            ], 500);
        }
    }

    /**
     * API: Mark notification as read
     */
    public function markNotificationRead($id): JsonResponse
    {
        try {
            // In real implementation, you would update notification in database
            // For now, just return success
            
            return response()->json([
                'status' => 'success',
                'message' => 'Notifikasi ditandai sebagai sudah dibaca'
            ]);

        } catch (\Exception $e) {
            Log::error('Error marking notification as read: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menandai notifikasi'
            ], 500);
        }
    }

    /**
     * API: Global search for admin dashboard
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q');
            $limit = $request->get('limit', 10);

            if (empty($query)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Query pencarian tidak boleh kosong'
                ], 400);
            }

            $results = [];

            // Search berita
            $berita = Berita::where('judul', 'like', "%{$query}%")
                ->orWhere('konten', 'like', "%{$query}%")
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get(['id', 'judul', 'slug', 'status', 'created_at']);

            foreach ($berita as $item) {
                $results[] = [
                    'type' => 'berita',
                    'title' => $item->judul,
                    'url' => route('admin.berita.edit', $item->id),
                    'description' => 'Berita • ' . ucfirst($item->status),
                    'date' => $item->created_at->diffForHumans()
                ];
            }

            // Search agenda
            $agenda = Agenda::where('judul', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%")
                ->orWhere('tempat', 'like', "%{$query}%")
                ->orderBy('tanggal_mulai', 'desc')
                ->limit($limit)
                ->get(['id', 'judul', 'slug', 'status', 'tanggal_mulai', 'tempat']);

            foreach ($agenda as $item) {
                $results[] = [
                    'type' => 'agenda',
                    'title' => $item->judul,
                    'url' => route('admin.agenda.edit', $item->id),
                    'description' => 'Agenda • ' . $item->tempat,
                    'date' => $item->tanggal_mulai->format('d M Y')
                ];
            }

            return response()->json([
                'status' => 'success',
                'data' => $results,
                'total' => count($results),
                'query' => $query
            ]);

        } catch (\Exception $e) {
            Log::error('Error in dashboard search: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal melakukan pencarian',
                'data' => [],
                'total' => 0
            ], 500);
        }
    }

    /**
     * API: Toggle item status (berita/agenda)
     */
    public function toggleStatus(Request $request): JsonResponse
    {
        try {
            $type = $request->get('type'); // 'berita' or 'agenda'
            $id = $request->get('id');

            if ($type === 'berita') {
                $item = Berita::findOrFail($id);
                $item->status = $item->status === 'published' ? 'draft' : 'published';
                
                if ($item->status === 'published' && !$item->published_at) {
                    $item->published_at = now();
                }
                
            } elseif ($type === 'agenda') {
                $item = Agenda::findOrFail($id);
                $item->status = $item->status === 'aktif' ? 'nonaktif' : 'aktif';
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tipe tidak valid'
                ], 400);
            }

            $item->updated_by = Auth::guard('admin')->id();
            $item->save();

            // Clear relevant cache
            Cache::forget('admin_dashboard_stats');

            return response()->json([
                'status' => 'success',
                'message' => 'Status berhasil diubah',
                'new_status' => $item->status
            ]);

        } catch (\Exception $e) {
            Log::error('Error toggling status: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}