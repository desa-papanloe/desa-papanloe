<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        // Get featured/latest news (max 6 for hero section and news section)
        $featuredBerita = Cache::remember('home_featured_news', 300, function () {
            return Berita::where('status', 'published')
                ->where('is_featured', true)
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get();
        });

        // Get latest news for news section
        $latestNews = Cache::remember('home_latest_news', 300, function () {
            return Berita::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->take(6)
                ->get();
        });

        // Get upcoming agenda/events (max 6)
        $upcomingAgenda = Cache::remember('home_upcoming_agenda', 300, function () {
            return Agenda::where('status', 'aktif')
                ->where('tanggal_mulai', '>=', now())
                ->orderBy('tanggal_mulai', 'asc')
                ->take(6)
                ->get();
        });

        // Get statistics for hero section
        $statistics = Cache::remember('home_statistics', 600, function () {
            return [
                'total_berita' => Berita::where('status', 'published')->count(),
                'total_agenda' => Agenda::where('status', 'aktif')->count(),
                'agenda_bulan_ini' => Agenda::where('status', 'aktif')
                    ->whereMonth('tanggal_mulai', now()->month)
                    ->whereYear('tanggal_mulai', now()->year)
                    ->count(),
                'berita_bulan_ini' => Berita::where('status', 'published')
                    ->whereMonth('published_at', now()->month)
                    ->whereYear('published_at', now()->year)
                    ->count(),
            ];
        });

        return view('beranda', compact(
            'featuredBerita',
            'latestNews', 
            'upcomingAgenda',
            'statistics'
        ));
    }

    /**
     * Display all news page
     */
    public function berita(Request $request)
    {
        $query = Berita::where('status', 'published');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->get('kategori'));
        }

        // Get available categories for filter
        $categories = Berita::where('status', 'published')
            ->select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->values();

        // Paginate results
        $berita = $query->orderBy('published_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        // Get featured news for sidebar
        $featuredBerita = Cache::remember('sidebar_featured_news', 300, function () {
            return Berita::where('status', 'published')
                ->where('is_featured', true)
                ->orderBy('published_at', 'desc')
                ->take(5)
                ->get();
        });

        return view('pages.berita', compact(
            'berita',
            'featuredBerita',
            'categories'
        ));
    }

    /**
     * Display single news detail
     */
    public function beritaDetail($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Increment views
        $berita->increment('views');

        // Get related news (same category, exclude current)
        $relatedNews = Berita::where('status', 'published')
            ->where('kategori', $berita->kategori)
            ->where('id', '!=', $berita->id)
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        // Get latest news for sidebar
        $latestNews = Cache::remember('sidebar_latest_news', 300, function () {
            return Berita::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->take(5)
                ->get();
        });

        return view('pages.berita-detail', compact(
            'berita',
            'relatedNews',
            'latestNews'
        ));
    }

    /**
     * Display all agenda page
     */
    public function agenda(Request $request)
    {
        $query = Agenda::where('status', 'aktif');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->get('kategori'));
        }

        // Date filter
        if ($request->filled('bulan')) {
            $bulan = $request->get('bulan');
            $tahun = $request->get('tahun', now()->year);
            $query->whereMonth('tanggal_mulai', $bulan)
                  ->whereYear('tanggal_mulai', $tahun);
        }

        // Get available categories and months for filter
        $categories = Agenda::where('status', 'aktif')
            ->select('kategori')
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->values();

        $availableMonths = Agenda::where('status', 'aktif')
            ->selectRaw('MONTH(tanggal_mulai) as bulan, YEAR(tanggal_mulai) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'asc')
            ->get()
            ->map(function($item) {
                return [
                    'bulan' => $item->bulan,
                    'tahun' => $item->tahun,
                    'nama_bulan' => Carbon::create()->month($item->bulan)->format('F')
                ];
            });

        // Paginate results
        $agenda = $query->orderBy('tanggal_mulai', 'asc')
            ->paginate(12)
            ->withQueryString();

        // Get upcoming events for sidebar
        $upcomingEvents = Cache::remember('sidebar_upcoming_events', 300, function () {
            return Agenda::where('status', 'aktif')
                ->where('tanggal_mulai', '>=', now())
                ->orderBy('tanggal_mulai', 'asc')
                ->take(5)
                ->get();
        });

        return view('pages.agenda', compact(
            'agenda',
            'upcomingEvents',
            'categories',
            'availableMonths'
        ));
    }

    /**
     * Display single agenda detail
     */
    public function agendaDetail($slug)
    {
        $agenda = Agenda::where('slug', $slug)
            ->where('status', 'aktif')
            ->firstOrFail();

        // Increment views
        $agenda->increment('views');

        // Get related agenda (same category, exclude current)
        $relatedAgenda = Agenda::where('status', 'aktif')
            ->where('kategori', $agenda->kategori)
            ->where('id', '!=', $agenda->id)
            ->orderBy('tanggal_mulai', 'asc')
            ->take(4)
            ->get();

        // Get upcoming events for sidebar
        $upcomingEvents = Cache::remember('sidebar_upcoming_events', 300, function () {
            return Agenda::where('status', 'aktif')
                ->where('tanggal_mulai', '>=', now())
                ->orderBy('tanggal_mulai', 'asc')
                ->take(5)
                ->get();
        });

        return view('pages.agenda-detail', compact(
            'agenda',
            'relatedAgenda',
            'upcomingEvents'
        ));
    }

    /**
     * Display search results
     */
    public function search(Request $request)
    {
        $search = $request->get('q');
        
        if (empty($search)) {
            return redirect()->route('home');
        }

        // Search in news
        $berita = Berita::where('status', 'published')
            ->where(function($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%")
                      ->orWhere('konten', 'like', "%{$search}%");
            })
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        // Search in agenda
        $agenda = Agenda::where('status', 'aktif')
            ->where(function($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhere('lokasi', 'like', "%{$search}%");
            })
            ->orderBy('tanggal_mulai', 'asc')
            ->take(5)
            ->get();

        $totalResults = $berita->count() + $agenda->count();

        return view('pages.search', compact(
            'search',
            'berita',
            'agenda', 
            'totalResults'
        ));
    }

    /**
     * Display sejarah page
     */
    public function sejarah()
    {
        $pageTitle = 'Sejarah Desa';
        $pageDescription = 'Sejarah panjang dan tradisi yang kaya dari Desa Papanloe sejak didirikan hingga saat ini.';

        return view('pages.sejarah', compact('pageTitle', 'pageDescription'));
    }

    /**
     * Display visi misi page
     */
    public function visiMisi()
    {
        $pageTitle = 'Visi & Misi Desa';
        $pageDescription = 'Visi dan misi Desa Papanloe dalam membangun masa depan yang berkelanjutan dan sejahtera.';

        return view('pages.visi-misi', compact('pageTitle', 'pageDescription'));
    }

    /**
     * Display struktur organisasi page
     */
    public function struktur()
    {
        $pageTitle = 'Struktur Organisasi';
        $pageDescription = 'Susunan perangkat desa dan struktur organisasi pemerintahan Desa Papanloe.';

        return view('pages.struktur', compact('pageTitle', 'pageDescription'));
    }

    /**
     * Display galeri page
     */
    public function galeri()
    {
        $pageTitle = 'Galeri Desa';
        $pageDescription = 'Dokumentasi visual kegiatan dan potensi Desa Papanloe melalui foto dan video.';

        return view('pages.galeri', compact('pageTitle', 'pageDescription'));
    }

    /**
     * Display peta page
     */
    public function peta()
    {
        $pageTitle = 'Peta Administrasi Desa';
        $pageDescription = 'Peta digital administrasi wilayah Desa Papanloe dengan pembagian dusun dan informasi geografis.';

        // Map information data
        $mapInfo = [
            'coordinate_system' => 'GCS WGS 1984',
            'datum' => 'WGS 1984',
            'scale' => '1:36.165',
            'range' => '0 - 2 Kilometers',
            'source' => 'KKNT Gel. 114 Universitas Hasanuddin',
            'year' => '2025'
        ];

        // Dusun information
        $dusunList = [
            [
                'nama' => 'Dusun Kayuloe',
                'warna' => 'orange',
                'deskripsi' => 'Wilayah bagian timur dengan akses ke jalan utama',
                'karakteristik' => 'Permukiman dan perdagangan'
            ],
            [
                'nama' => 'Dusun Balla Tiggia', 
                'warna' => 'green',
                'deskripsi' => 'Kawasan permukiman dengan fasilitas umum',
                'karakteristik' => 'Pusat layanan masyarakat'
            ],
            [
                'nama' => 'Dusun Mawang',
                'warna' => 'yellow', 
                'deskripsi' => 'Area pertanian dan perkebunan',
                'karakteristik' => 'Sektor pertanian utama'
            ],
            [
                'nama' => 'Dusun Bungungrua',
                'warna' => 'blue',
                'deskripsi' => 'Wilayah industri dan pengolahan',
                'karakteristik' => 'Zona industri dan manufaktur'
            ],
            [
                'nama' => 'Dusun Sapamayo',
                'warna' => 'purple',
                'deskripsi' => 'Kawasan budidaya dan perikanan', 
                'karakteristik' => 'Budidaya air tawar'
            ],
            [
                'nama' => 'Dusun Bungung Pandang',
                'warna' => 'teal',
                'deskripsi' => 'Area pantai dan budidaya rumput laut',
                'karakteristik' => 'Wilayah pesisir dan maritim'
            ],
            [
                'nama' => 'Dusun Papanloe',
                'warna' => 'emerald', 
                'deskripsi' => 'Pusat pemerintahan dan kantor desa',
                'karakteristik' => 'Pusat administrasi desa'
            ]
        ];

        // Statistics for the map page
        $statistics = [
            'total_dusun' => count($dusunList),
            'total_rw' => 12, // Contoh data
            'total_rt' => 24, // Contoh data
            'luas_wilayah' => '15.6 km²' // Contoh data
        ];

        return view('pages.peta', compact(
            'pageTitle', 
            'pageDescription',
            'mapInfo',
            'dusunList', 
            'statistics'
        ));
    }

    /**
     * Display kontak page
     */
    public function kontak()
    {
        $pageTitle = 'Kontak Kami';
        $pageDescription = 'Informasi kontak dan lokasi kantor Desa Papanloe untuk layanan masyarakat.';

        return view('pages.kontak', compact('pageTitle', 'pageDescription'));
    }

    /**
     * Display tentang page
     */
    public function tentang()
    {
        $pageTitle = 'Tentang Website';
        $pageDescription = 'Informasi tentang website resmi Desa Papanloe dan layanan digital yang tersedia.';

        return view('pages.tentang', compact('pageTitle', 'pageDescription'));
    }
}