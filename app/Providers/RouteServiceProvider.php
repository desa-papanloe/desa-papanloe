<?php
// app/Providers/RouteServiceProvider.php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';
    
    /**
     * The path to admin login route.
     *
     * @var string
     */
    public const ADMIN_LOGIN = '/admin/login';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // Configure rate limiters
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('admin', function (Request $request) {
            return Limit::perMinute(100)->by($request->user()?->id ?: $request->ip());
        });

        // Configure route model bindings
        $this->configureRouteModelBinding();
    }

    /**
     * Configure route model bindings
     */
    protected function configureRouteModelBinding(): void
    {
        // Berita model binding by slug
        Route::bind('berita', function ($value) {
            return \App\Models\Berita::where('slug', $value)->firstOrFail();
        });

        // Agenda model binding by slug
        Route::bind('agenda', function ($value) {
            return \App\Models\Agenda::where('slug', $value)->firstOrFail();
        });

        // Admin model binding by id
        Route::bind('admin', function ($value) {
            return \App\Models\Admin::findOrFail($value);
        });
    }
}