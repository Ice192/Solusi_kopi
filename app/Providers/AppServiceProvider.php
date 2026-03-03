<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $appUrl = (string) config('app.url', '');
        $shouldForceHttps = app()->environment('production')
            || config('app.force_https')
            || str_starts_with($appUrl, 'https://');

        if ($shouldForceHttps) {
            URL::forceScheme('https');
        }
    }
}
