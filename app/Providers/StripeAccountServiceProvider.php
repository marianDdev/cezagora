<?php

namespace App\Providers;

use App\Services\Stripe\Account\StripeAccountService;
use Illuminate\Support\ServiceProvider;

class StripeAccountServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\Stripe\Account\StripeAccountServiceInterface', fn() => new StripeAccountService());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
