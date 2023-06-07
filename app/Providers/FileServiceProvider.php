<?php

namespace App\Providers;

use App\Services\FileService;
use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\FileServiceInterface', function () {
            return new FileService();
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
