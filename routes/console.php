<?php
// routes/console.php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Custom Console Commands
|--------------------------------------------------------------------------
*/

// Clear all caches
Artisan::command('cache:clear-all', function () {
    $this->call('cache:clear');
    $this->call('config:clear');
    $this->call('route:clear');
    $this->call('view:clear');
    $this->info('All caches cleared successfully!');
})->purpose('Clear all application caches');

// Setup admin user
Artisan::command('admin:create {name} {email} {password?}', function ($name, $email, $password = null) {
    $password = $password ?: 'password123';
    
    \App\Models\Admin::create([
        'name' => $name,
        'email' => $email,
        'password' => \Hash::make($password),
        'role' => 'super_admin',
        'is_active' => true,
    ]);
    
    $this->info("Admin user created successfully!");
    $this->line("Email: {$email}");
    $this->line("Password: {$password}");
})->purpose('Create a new admin user');

// Website stats
Artisan::command('website:stats', function () {
    $totalBerita = \App\Models\Berita::count();
    $publishedBerita = \App\Models\Berita::where('status', 'published')->count();
    $totalAgenda = \App\Models\Agenda::count();
    $activeAgenda = \App\Models\Agenda::where('status', 'aktif')->count();
    $totalAdmins = \App\Models\Admin::count();
    
    $this->info('Website Statistics:');
    $this->line("Total Berita: {$totalBerita} (Published: {$publishedBerita})");
    $this->line("Total Agenda: {$totalAgenda} (Active: {$activeAgenda})");
    $this->line("Total Admins: {$totalAdmins}");
})->purpose('Display website statistics');