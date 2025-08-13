<?php
// routes/web.php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Homepage Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Berita Routes (Public)
|--------------------------------------------------------------------------
*/
Route::prefix('berita')->name('berita.')->group(function () {
    // Main berita listing page
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    
    // Berita detail page (by slug)
    Route::get('/{berita:slug}', [BeritaController::class, 'show'])->name('show');
    
    // Berita by category
    Route::get('/kategori/{kategori}', [BeritaController::class, 'kategori'])->name('kategori');
    
    // Berita archive
    Route::get('/arsip', [BeritaController::class, 'archive'])->name('archive');
    
    // RSS Feed
    Route::get('/rss', [BeritaController::class, 'rss'])->name('rss');
    
    // Sitemap
    Route::get('/sitemap.xml', [BeritaController::class, 'sitemap'])->name('sitemap');
});

/*
|--------------------------------------------------------------------------
| Agenda Routes (Public) - CORRECTED
|--------------------------------------------------------------------------
*/
Route::prefix('agenda')->name('agenda.')->group(function () {
    // Main agenda listing page
    Route::get('/', [AgendaController::class, 'index'])->name('index');
    
    // AJAX/API endpoints - HARUS SEBELUM parameter routes
    Route::get('/upcoming', [AgendaController::class, 'upcoming'])->name('upcoming');
    Route::get('/search', [AgendaController::class, 'search'])->name('search');
    
    // API endpoints untuk AJAX
    Route::get('/api/upcoming', [AgendaController::class, 'upcoming'])->name('api.upcoming');
    Route::get('/api/search', [AgendaController::class, 'search'])->name('api.search');
    
    // Category route
    Route::get('/kategori/{kategori}', [AgendaController::class, 'kategori'])->name('kategori');
    
    Route::get('/{slug}', [AgendaController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Static Pages Routes
|--------------------------------------------------------------------------
*/
// Profil Desa
Route::get('/sejarah', [HomeController::class, 'sejarah'])->name('sejarah');
Route::get('/visi-misi', [HomeController::class, 'visiMisi'])->name('visi-misi');
Route::get('/struktur', [HomeController::class, 'struktur'])->name('struktur');

// Galeri
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');

// Peta Digital
Route::get('/peta', [HomeController::class, 'peta'])->name('peta');

// Kontak
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

// Tentang
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');

/*
|--------------------------------------------------------------------------
| Search Routes
|--------------------------------------------------------------------------
*/
Route::get('/search', [HomeController::class, 'search'])->name('search');

/*
|--------------------------------------------------------------------------
| Redirect Routes for Backward Compatibility
|--------------------------------------------------------------------------
*/
// Old berita URLs
Route::redirect('/news', '/berita', 301);
Route::redirect('/berita.php', '/berita', 301);

// Old agenda URLs  
Route::redirect('/events', '/agenda', 301);
Route::redirect('/agenda.php', '/agenda', 301);

// Old admin URLs (redirect to new admin path)
Route::redirect('/administrator', '/admin', 301);
Route::redirect('/admin.php', '/admin', 301);

// Old peta URLs (untuk backward compatibility)
Route::redirect('/map', '/peta', 301);
Route::redirect('/maps', '/peta', 301);
Route::redirect('/peta.php', '/peta', 301);

/*
|--------------------------------------------------------------------------
| SEO Routes
|--------------------------------------------------------------------------
*/
// Main sitemap
Route::get('/sitemap.xml', function () {
    return response()->view('sitemaps.main')
        ->header('Content-Type', 'application/xml');
})->name('sitemap.main');

// Robots.txt
Route::get('/robots.txt', function () {
    $content = "User-agent: *\n";
    $content .= "Allow: /\n";
    $content .= "Disallow: /admin/\n";
    $content .= "Disallow: /api/\n";
    $content .= "\n";
    $content .= "Sitemap: " . url('/sitemap.xml') . "\n";
    
    return response($content)
        ->header('Content-Type', 'text/plain');
})->name('robots');

/*
|--------------------------------------------------------------------------
| Health Check Route
|--------------------------------------------------------------------------
*/
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
        'uptime' => 'running',
        'version' => config('app.version', '1.0.0')
    ]);
})->name('health');

/*
|--------------------------------------------------------------------------
| Fallback Route for 404 Errors
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});