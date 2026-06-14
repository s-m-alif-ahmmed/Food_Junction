<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        // Force HTTPS if APP_URL is https or if running behind a proxy with https
        if (str_contains(config('app.url'), 'https://') || request()->header('x-forwarded-proto') === 'https' || !app()->environment('local')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
