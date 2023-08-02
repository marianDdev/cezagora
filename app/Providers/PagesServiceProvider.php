<?php

namespace App\Providers;

use App\Services\Pages\PagesService;
use Illuminate\Support\ServiceProvider;

class PagesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\Pages\PagesServiceInterface', function () {
            return new PagesService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
