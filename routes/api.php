<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Default API Route
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| API Health Check
|--------------------------------------------------------------------------
*/
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is running',
        'timestamp' => now()->toISOString(),
        'version' => '1.0.0'
    ]);
});

/*
|--------------------------------------------------------------------------
| Public API Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

// Berita API Routes
Route::prefix('berita')->group(function () {
    Route::get('/latest', [\App\Http\Controllers\BeritaController::class, 'apiLatest']);
    Route::get('/popular', [\App\Http\Controllers\BeritaController::class, 'apiPopular']);
    Route::get('/search', [\App\Http\Controllers\BeritaController::class, 'apiSearch']);
    Route::get('/kategori/{kategori}', [\App\Http\Controllers\BeritaController::class, 'apiByKategori']);
});

// Agenda API Routes
Route::prefix('agenda')->group(function () {
    Route::get('/upcoming', [\App\Http\Controllers\AgendaController::class, 'upcoming']);
    Route::get('/search', [\App\Http\Controllers\AgendaController::class, 'search']);
    Route::get('/calendar/{year}/{month}', [\App\Http\Controllers\AgendaController::class, 'calendarData']);
    Route::get('/kategori/{kategori}', [\App\Http\Controllers\AgendaController::class, 'apiByKategori']);
});

/*
|--------------------------------------------------------------------------
| Statistics API (Public)
|--------------------------------------------------------------------------
*/
Route::get('/statistics', function () {
    try {
        return response()->json([
            'status' => 'success',
            'data' => [
                'total_berita' => \App\Models\Berita::where('status', 'published')->count(),
                'total_agenda' => \App\Models\Agenda::where('status', 'aktif')->count(),
                'berita_bulan_ini' => \App\Models\Berita::where('status', 'published')
                    ->whereMonth('created_at', now()->month)
                    ->count(),
                'agenda_mendatang' => \App\Models\Agenda::where('status', 'aktif')
                    ->where('tanggal_mulai', '>=', now())
                    ->count(),
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to get statistics'
        ], 500);
    }
});

/*
|--------------------------------------------------------------------------
| Admin API Routes (Authentication Required)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    
    // Dashboard API
    Route::get('/dashboard/stats', [\App\Http\Controllers\Admin\DashboardController::class, 'statistics']);
    Route::get('/dashboard/activities', [\App\Http\Controllers\Admin\DashboardController::class, 'activities']);
    Route::get('/dashboard/notifications', [\App\Http\Controllers\Admin\DashboardController::class, 'notifications']);
    
    // Quick actions API
    Route::post('/berita/{berita}/toggle-status', function(\App\Models\Berita $berita) {
        $berita->status = $berita->status === 'published' ? 'draft' : 'published';
        $berita->save();
        
        return response()->json([
            'status' => 'success',
            'new_status' => $berita->status
        ]);
    });
    
    Route::post('/agenda/{agenda}/toggle-status', function(\App\Models\Agenda $agenda) {
        $agenda->status = $agenda->status === 'aktif' ? 'nonaktif' : 'aktif';
        $agenda->save();
        
        return response()->json([
            'status' => 'success',
            'new_status' => $agenda->status
        ]);
    });
});

/*
|--------------------------------------------------------------------------
| Fallback API Route
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'API endpoint not found',
        'code' => 404
    ], 404);
});