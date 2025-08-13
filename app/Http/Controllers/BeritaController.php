<?php
// app/Http/Controllers/BeritaController.php (Public/Frontend) - NO IMAGES VERSION

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BeritaController extends Controller
{
    /**
     * Display a listing of berita (Public)
     */
    public function index(Request $request)
    {
        $query = Berita::where('status', 'published')->with(['creator:id,name']);

        // Filter by kategori
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'latest':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        // Paginate results
        $berita = $query->paginate(12)->withQueryString();

        // Get data for sidebar/filters
        $kategoris = [
            'berita-desa' => 'Berita Desa',
            'pengumuman' => 'Pengumuman',
            'kegiatan' => 'Kegiatan',
            'pembangunan' => 'Pembangunan',
            'sosial' => 'Sosial',
            'ekonomi' => 'Ekonomi',
            'kesehatan' => 'Kesehatan',
            'pendidikan' => 'Pendidikan',
            'lainnya' => 'Lainnya'
        ];

        // Get featured news for sidebar
        $featuredBerita = Cache::remember('public_featured_berita', 300, function () {
            return Berita::where('status', 'published')
                ->where('is_featured', true)
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        });

        // Get popular news for sidebar
        $popularBerita = Cache::remember('public_popular_berita', 300, function () {
            return Berita::where('status', 'published')
                ->orderBy('views', 'desc')
                ->limit(5)
                ->get();
        });

        // Meta data for SEO
        $pageTitle = 'Berita Desa';
        $pageDescription = 'Kumpulan berita terbaru dan informasi penting dari desa kami. Tetap update dengan perkembangan dan kegiatan desa.';

        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $kategoriLabel = $kategoris[$request->kategori] ?? ucfirst($request->kategori);
            $pageTitle = "Berita {$kategoriLabel}";
            $pageDescription = "Berita dan informasi terbaru seputar {$kategoriLabel} di desa kami.";
        }

        if ($request->filled('search')) {
            $pageTitle = "Hasil Pencarian: {$request->search}";
            $pageDescription = "Hasil pencarian berita untuk kata kunci: {$request->search}";
        }

        return view('pages.berita', compact(
            'berita', 
            'kategoris', 
            'featuredBerita', 
            'popularBerita',
            'pageTitle',
            'pageDescription'
        ));
    }

    /**
     * Display the specified berita detail
     */
    public function show(Berita $berita)
    {
        // Check if berita is published
        if ($berita->status !== 'published') {
            abort(404, 'Berita tidak ditemukan atau belum dipublikasi.');
        }

        // Increment views
        $berita->increment('views');

        // Load creator relationship
        $berita->load(['creator:id,name']);

        // Get related berita (same category, exclude current)
        $relatedBerita = Berita::where('status', 'published')
            ->where('kategori', $berita->kategori)
            ->where('id', '!=', $berita->id)
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        // Get latest berita for sidebar
        $latestBerita = Cache::remember('sidebar_latest_berita', 300, function () use ($berita) {
            return Berita::where('status', 'published')
                ->where('id', '!=', $berita->id)
                ->orderBy('published_at', 'desc')
                ->limit(5)
                ->get();
        });

        // Get popular berita for sidebar
        $popularBerita = Cache::remember('sidebar_popular_berita', 300, function () use ($berita) {
            return Berita::where('status', 'published')
                ->where('id', '!=', $berita->id)
                ->orderBy('views', 'desc')
                ->limit(5)
                ->get();
        });

        // Meta data for SEO
        $pageTitle = $berita->judul;
        $pageDescription = $berita->meta_description ?: ($berita->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($berita->konten), 160));

        return view('pages.berita-detail', compact(
            'berita',
            'relatedBerita',
            'latestBerita',
            'popularBerita',
            'pageTitle',
            'pageDescription'
        ));
    }

    /**
     * Display berita by kategori
     */
    public function kategori(Request $request, $kategori)
    {
        $kategoris = [
            'berita-desa' => 'Berita Desa',
            'pengumuman' => 'Pengumuman',
            'kegiatan' => 'Kegiatan',
            'pembangunan' => 'Pembangunan',
            'sosial' => 'Sosial',
            'ekonomi' => 'Ekonomi',
            'kesehatan' => 'Kesehatan',
            'pendidikan' => 'Pendidikan',
            'lainnya' => 'Lainnya'
        ];

        // Check if kategori exists
        if (!array_key_exists($kategori, $kategoris)) {
            abort(404, 'Kategori tidak ditemukan.');
        }

        $query = Berita::where('status', 'published')
            ->where('kategori', $kategori)
            ->with(['creator:id,name']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'latest':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        $berita = $query->paginate(12)->withQueryString();

        // Get featured news for sidebar (without images)
        $featuredBerita = Cache::remember("featured_berita_{$kategori}", 300, function () use ($kategori) {
            return Berita::where('status', 'published')
                ->where('kategori', $kategori)
                ->where('is_featured', true)
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        });

        $kategoriLabel = $kategoris[$kategori];
        $pageTitle = "Berita {$kategoriLabel}";
        $pageDescription = "Kumpulan berita dan informasi terbaru seputar {$kategoriLabel} di desa kami.";

        return view('pages.berita', compact(
            'berita',
            'kategoris',
            'featuredBerita',
            'kategori',
            'kategoriLabel',
            'pageTitle',
            'pageDescription'
        ));
    }

    /**
     * Display berita archive
     */
    public function archive(Request $request)
    {
        $query = Berita::where('status', 'published')->with(['creator:id,name']);

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('published_at', $request->year);
        }

        // Filter by month
        if ($request->filled('month')) {
            $query->whereMonth('published_at', $request->month);
        }

        $berita = $query->orderBy('published_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        // Get available years and months for filter
        $availableYears = Berita::where('status', 'published')
            ->selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $availableMonths = collect(range(1, 12))->map(function($month) {
            return [
                'number' => $month,
                'name' => Carbon::create()->month($month)->format('F'),
                'name_id' => Carbon::create()->month($month)->locale('id')->format('F')
            ];
        });

        $pageTitle = 'Arsip Berita';
        $pageDescription = 'Arsip berita dan artikel yang telah dipublikasikan sebelumnya.';

        return view('pages.berita-archive', compact(
            'berita',
            'availableYears',
            'availableMonths',
            'pageTitle',
            'pageDescription'
        ));
    }

    /**
     * RSS Feed for berita
     */
    public function rss()
    {
        $berita = Berita::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(20)
            ->get();

        return response()->view('feeds.berita', compact('berita'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Sitemap XML for berita
     */
    public function sitemap()
    {
        $berita = Berita::where('status', 'published')
            ->select(['slug', 'updated_at'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->view('sitemaps.berita', compact('berita'))
            ->header('Content-Type', 'application/xml');
    }

    /**
     * API: Get latest berita for AJAX requests
     */
    public function apiLatest(Request $request): JsonResponse
    {
        try {
            $limit = $request->get('limit', 5);
            $exclude = $request->get('exclude'); // Exclude specific berita ID

            $query = Berita::where('status', 'published')->with(['creator:id,name']);

            if ($exclude) {
                $query->where('id', '!=', $exclude);
            }

            $berita = $query->orderBy('published_at', 'desc')
                          ->limit($limit)
                          ->get()
                          ->map(function($item) {
                              return [
                                  'id' => $item->id,
                                  'judul' => $item->judul,
                                  'slug' => $item->slug,
                                  'excerpt' => \Illuminate\Support\Str::limit($item->excerpt, 100),
                                  'kategori' => $item->kategori,
                                  'kategori_label' => ucfirst(str_replace('-', ' ', $item->kategori)),
                                  'views' => number_format($item->views),
                                  'published_at' => $item->published_at->format('d M Y'),
                                  'author' => $item->creator->name ?? 'Admin Desa',
                                  'url' => route('berita.show', $item->slug),
                              ];
                          });

            return response()->json([
                'status' => 'success',
                'data' => $berita,
                'total' => $berita->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Get popular berita for AJAX requests
     */
    public function apiPopular(Request $request): JsonResponse
    {
        try {
            $limit = $request->get('limit', 5);
            $exclude = $request->get('exclude');

            $query = Berita::where('status', 'published')->with(['creator:id,name']);

            if ($exclude) {
                $query->where('id', '!=', $exclude);
            }

            $berita = $query->orderBy('views', 'desc')
                          ->limit($limit)
                          ->get()
                          ->map(function($item) {
                              return [
                                  'id' => $item->id,
                                  'judul' => $item->judul,
                                  'slug' => $item->slug,
                                  'excerpt' => \Illuminate\Support\Str::limit($item->excerpt, 100),
                                  'kategori' => $item->kategori,
                                  'kategori_label' => ucfirst(str_replace('-', ' ', $item->kategori)),
                                  'views' => number_format($item->views),
                                  'published_at' => $item->published_at->format('d M Y'),
                                  'author' => $item->creator->name ?? 'Admin Desa',
                                  'url' => route('berita.show', $item->slug),
                              ];
                          });

            return response()->json([
                'status' => 'success',
                'data' => $berita,
                'total' => $berita->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Search berita for AJAX requests
     */
    public function apiSearch(Request $request): JsonResponse
    {
        try {
            $search = $request->get('q');
            $limit = $request->get('limit', 10);

            if (empty($search)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Query pencarian tidak boleh kosong'
                ], 400);
            }

            $query = Berita::where('status', 'published')
                ->with(['creator:id,name'])
                ->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%")
                      ->orWhere('konten', 'like', "%{$search}%");
                });

            $berita = $query->orderBy('published_at', 'desc')
                          ->limit($limit)
                          ->get()
                          ->map(function($item) {
                              return [
                                  'id' => $item->id,
                                  'judul' => $item->judul,
                                  'slug' => $item->slug,
                                  'excerpt' => \Illuminate\Support\Str::limit($item->excerpt, 100),
                                  'kategori' => $item->kategori,
                                  'kategori_label' => ucfirst(str_replace('-', ' ', $item->kategori)),
                                  'views' => number_format($item->views),
                                  'published_at' => $item->published_at->format('d M Y'),
                                  'author' => $item->creator->name ?? 'Admin Desa',
                                  'url' => route('berita.show', $item->slug),
                              ];
                          });

            return response()->json([
                'status' => 'success',
                'data' => $berita,
                'total' => $berita->count(),
                'query' => $search
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal melakukan pencarian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Get berita by kategori for AJAX requests
     */
    public function apiByKategori(Request $request, $kategori): JsonResponse
    {
        try {
            $kategoris = [
                'berita-desa' => 'Berita Desa',
                'pengumuman' => 'Pengumuman',
                'kegiatan' => 'Kegiatan',
                'pembangunan' => 'Pembangunan',
                'sosial' => 'Sosial',
                'ekonomi' => 'Ekonomi',
                'kesehatan' => 'Kesehatan',
                'pendidikan' => 'Pendidikan',
                'lainnya' => 'Lainnya'
            ];

            if (!array_key_exists($kategori, $kategoris)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori tidak ditemukan'
                ], 404);
            }

            $limit = $request->get('limit', 10);
            $exclude = $request->get('exclude');

            $query = Berita::where('status', 'published')
                ->where('kategori', $kategori)
                ->with(['creator:id,name']);

            if ($exclude) {
                $query->where('id', '!=', $exclude);
            }

            $berita = $query->orderBy('published_at', 'desc')
                          ->limit($limit)
                          ->get()
                          ->map(function($item) {
                              return [
                                  'id' => $item->id,
                                  'judul' => $item->judul,
                                  'slug' => $item->slug,
                                  'excerpt' => \Illuminate\Support\Str::limit($item->excerpt, 100),
                                  'kategori' => $item->kategori,
                                  'kategori_label' => ucfirst(str_replace('-', ' ', $item->kategori)),
                                  'views' => number_format($item->views),
                                  'published_at' => $item->published_at->format('d M Y'),
                                  'author' => $item->creator->name ?? 'Admin Desa',
                                  'url' => route('berita.show', $item->slug),
                              ];
                          });

            return response()->json([
                'status' => 'success',
                'data' => $berita,
                'total' => $berita->count(),
                'kategori' => $kategori,
                'kategori_label' => $kategoris[$kategori]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data berita: ' . $e->getMessage()
            ], 500);
        }
    }
}