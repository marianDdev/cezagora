<?php

namespace App\Providers;

use App\Services\Checkout\CheckoutService;
use Illuminate\Support\ServiceProvider;

class CheckoutServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\Checkout\CheckoutServiceInterface', function () {
            return new CheckoutService();
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
