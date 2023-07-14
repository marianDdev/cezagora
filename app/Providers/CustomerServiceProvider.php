<?php

namespace App\Providers;

use App\Services\Stripe\Customer\CustomerService;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\Stripe\Customer\CustomerServiceInterface', function () {
            return new CustomerService();
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
