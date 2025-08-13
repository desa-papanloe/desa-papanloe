<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Helpers\WhatsAppHelper;

class WhatsAppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register WhatsApp configuration
        $this->mergeConfigFrom(
            __DIR__.'/../../config/whatsapp.php', 'whatsapp'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish config file
        $this->publishes([
            __DIR__.'/../../config/whatsapp.php' => config_path('whatsapp.php'),
        ], 'whatsapp-config');

        // Share WhatsApp data with all views
        View::composer('*', function ($view) {
            $view->with('whatsappHelper', WhatsAppHelper::class);
        });

        // Add global view variables
        View::share('whatsappNumber', WhatsAppHelper::getPhoneNumber());
        View::share('whatsappDisplayNumber', WhatsAppHelper::formatPhoneForDisplay(config('whatsapp.phone_number')));
    }
}