<?php
// routes/admin.php - FIXED VERSION (NO IMAGE UPLOAD ROUTES)

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PengaturanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes - FIXED
|--------------------------------------------------------------------------
| 
| Routes untuk admin panel. Semua route di sini akan memiliki prefix 'admin'
| dan middleware 'web' sudah diterapkan di bootstrap/app.php.
|
*/

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest:admin')->group(function () {
    // Default admin route redirects to login
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });
    
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Forgot Password Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password.post');
    
    // Reset Password Routes
    Route::get('/reset-password/{token?}', [AuthController::class, 'showResetPasswordForm'])->name('reset-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password.post');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes (Authenticated Only)  
|--------------------------------------------------------------------------
*/
Route::middleware('auth:admin')->group(function () {
    
    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Dashboard API Routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/statistics', [DashboardController::class, 'statistics'])->name('statistics');
        Route::get('/activities', [DashboardController::class, 'activities'])->name('activities');
        Route::get('/notifications', [DashboardController::class, 'notifications'])->name('notifications');
        Route::get('/quick-stats', [DashboardController::class, 'quickStats'])->name('quick.stats');
        Route::post('/mark-notification-read/{id}', [DashboardController::class, 'markNotificationRead'])->name('notification.read');
        Route::get('/search', [DashboardController::class, 'search'])->name('search');
        Route::post('/toggle-status', [DashboardController::class, 'toggleStatus'])->name('toggle.status');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Kelola Berita Routes - FIXED (NO IMAGE UPLOAD ROUTES)
    |--------------------------------------------------------------------------
    */
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('index');
        Route::get('/datatables', [BeritaController::class, 'datatables'])->name('datatables');
        Route::get('/create', [BeritaController::class, 'create'])->name('create');
        Route::post('/', [BeritaController::class, 'store'])->name('store');
        Route::get('/{id}', [BeritaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BeritaController::class, 'update'])->name('update');
        Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('destroy');
        
        // Preview route
        Route::get('/{id}/preview', [BeritaController::class, 'preview'])->name('preview');
        
        // Status update route
        Route::patch('/{id}/status', [BeritaController::class, 'updateStatus'])->name('status');
        
        // Featured toggle route
        Route::post('/{id}/toggle-featured', [BeritaController::class, 'toggleFeatured'])->name('toggle-featured');
        
        // Bulk actions
        Route::post('/bulk-action', [BeritaController::class, 'bulkAction'])->name('bulk');
        
    });
    
    /*
    |--------------------------------------------------------------------------
    | Agenda Management Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('agenda')->name('agenda.')->group(function () {
        Route::get('/', [AgendaController::class, 'index'])->name('index');
        Route::get('/data', [AgendaController::class, 'data'])->name('data');
        Route::get('/create', [AgendaController::class, 'create'])->name('create');
        Route::post('/', [AgendaController::class, 'store'])->name('store');
        Route::get('/{id}', [AgendaController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AgendaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AgendaController::class, 'update'])->name('update');
        Route::delete('/{id}', [AgendaController::class, 'destroy'])->name('destroy');
        
        // Featured toggle route
        Route::post('/{id}/toggle-featured', [AgendaController::class, 'toggleFeatured'])->name('toggle-featured');
        
        // Calendar routes
        Route::get('/calendar/view', [AgendaController::class, 'calendar'])->name('calendar');
        Route::get('/calendar/data', [AgendaController::class, 'calendarData'])->name('calendar.data');
        
        // Bulk actions
        Route::post('/bulk/status', [AgendaController::class, 'bulkUpdateStatus'])->name('bulk.status');
        Route::post('/bulk/delete', [AgendaController::class, 'bulkDelete'])->name('bulk.delete');
        Route::post('/bulk/export', [AgendaController::class, 'bulkExport'])->name('bulk.export');
        
        // Export
        Route::get('/export', [AgendaController::class, 'export'])->name('export');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Profile Management Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    });
    
    /*
    |--------------------------------------------------------------------------
    | Settings Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [PengaturanController::class, 'index'])->name('index');
        Route::get('/general', [PengaturanController::class, 'general'])->name('general');
        Route::put('/general', [PengaturanController::class, 'updateGeneral'])->name('general.update');
        Route::get('/users', [PengaturanController::class, 'users'])->name('users');
        Route::post('/users', [PengaturanController::class, 'createUser'])->name('users.create');
        Route::put('/users/{admin}', [PengaturanController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{admin}', [PengaturanController::class, 'deleteUser'])->name('users.delete');
    });
});