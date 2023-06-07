<?php

namespace App\Providers;

use App\Services\AddressService;
use Illuminate\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\AddressServiceInterface', function () {
            return new AddressService();
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
