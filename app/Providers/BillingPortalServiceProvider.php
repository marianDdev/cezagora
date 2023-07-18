<?php

namespace App\Providers;

use App\Services\Stripe\BillingPortal\BillingPortalService;
use Illuminate\Support\ServiceProvider;

class BillingPortalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\Stripe\BillingPortal\BillingPortalServiceInterface', function () {
            return new BillingPortalService();
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
