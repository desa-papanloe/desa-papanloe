<?php
// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register any application services here
        if ($this->app->environment('local')) {
            // Only register Telescope if it's installed
            if (class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
                $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set default string length for older MySQL versions
        Schema::defaultStringLength(191);

        // Use Bootstrap for pagination views
        Paginator::useBootstrapFive();

        // Set Carbon locale to Indonesian
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.UTF-8', 'id_ID', 'Indonesian');

        // Share common data to all views
        $this->shareViewData();

        // Register view composers
        $this->registerViewComposers();
    }

    /**
     * Share common data to all views
     */
    protected function shareViewData(): void
    {
        View::share([
            'appName' => config('app.name', 'Desa Papanloe'),
            'appUrl' => config('app.url'),
            'currentYear' => date('Y'),
        ]);
    }

    /**
     * Register view composers
     */
    protected function registerViewComposers(): void
    {
        // Share navigation data to main layout
        View::composer(['layouts.app', 'layouts.admin'], function ($view) {
            $view->with([
                'currentRoute' => request()->route()?->getName(),
                'currentUrl' => request()->url(),
            ]);
        });

        // Share sidebar data to admin layout
        View::composer('layouts.admin', function ($view) {
            $adminUser = auth('admin')->check() ? auth('admin')->user() : null;
            
            $view->with([
                'adminUser' => $adminUser,
                'unreadNotifications' => 0, // You can implement actual notification counting
                'sidebarItems' => $this->getSidebarItems(),
            ]);
        });

        // Share footer data to public layout
        View::composer('layouts.app', function ($view) {
            $view->with([
                'footerLinks' => $this->getFooterLinks(),
                'socialLinks' => $this->getSocialLinks(),
            ]);
        });
    }

    /**
     * Get sidebar items for admin layout
     */
    protected function getSidebarItems(): array
    {
        try {
            return [
                [
                    'name' => 'Dashboard',
                    'route' => 'admin.dashboard',
                    'icon' => 'home',
                    'active' => request()->routeIs('admin.dashboard'),
                ],
                [
                    'name' => 'Kelola Berita',
                    'route' => 'admin.berita.index',
                    'icon' => 'newspaper',
                    'active' => request()->routeIs('admin.berita.*'),
                    'badge' => \App\Models\Berita::where('status', 'draft')->count(),
                ],
                [
                    'name' => 'Kelola Agenda',
                    'route' => 'admin.agenda.index',
                    'icon' => 'calendar',
                    'active' => request()->routeIs('admin.agenda.*'),
                    'badge' => \App\Models\Agenda::where('status', 'aktif')
                        ->where('tanggal_mulai', '>=', now())
                        ->count(),
                ],
                [
                    'name' => 'Pengaturan',
                    'route' => 'admin.settings.index',
                    'icon' => 'cog',
                    'active' => request()->routeIs('admin.settings.*'),
                ],
            ];
        } catch (\Exception $e) {
            // Return basic sidebar without database queries if there's an error
            return [
                [
                    'name' => 'Dashboard',
                    'route' => 'admin.dashboard',
                    'icon' => 'home',
                    'active' => request()->routeIs('admin.dashboard'),
                ],
                [
                    'name' => 'Kelola Berita',
                    'route' => 'admin.berita.index',
                    'icon' => 'newspaper',
                    'active' => request()->routeIs('admin.berita.*'),
                    'badge' => 0,
                ],
                [
                    'name' => 'Kelola Agenda',
                    'route' => 'admin.agenda.index',
                    'icon' => 'calendar',
                    'active' => request()->routeIs('admin.agenda.*'),
                    'badge' => 0,
                ],
                [
                    'name' => 'Pengaturan',
                    'route' => 'admin.settings.index',
                    'icon' => 'cog',
                    'active' => request()->routeIs('admin.settings.*'),
                ],
            ];
        }
    }

    /**
     * Get footer links for public layout
     */
    protected function getFooterLinks(): array
    {
        return [
            'Tentang' => [
                ['name' => 'Sejarah Desa', 'url' => route('sejarah')],
                ['name' => 'Visi & Misi', 'url' => route('visi-misi')],
                ['name' => 'Struktur Organisasi', 'url' => route('struktur')],
            ],
            'Informasi' => [
                ['name' => 'Berita Desa', 'url' => route('berita.index')],
                ['name' => 'Agenda Kegiatan', 'url' => route('agenda.index')],
                ['name' => 'Galeri', 'url' => route('galeri')],
            ],
            'Kontak' => [
                ['name' => 'Hubungi Kami', 'url' => route('kontak')],
                ['name' => 'Lokasi', 'url' => '#'],
            ],
        ];
    }

    /**
     * Get social media links
     */
    protected function getSocialLinks(): array
    {
        return [
            'facebook' => '#',
            'twitter' => '#',
            'instagram' => '#',
            'youtube' => '#',
        ];
    }
}