<?php

namespace App\Providers;

use App\Services\Stripe\Payment\PaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\Stripe\Payment\PaymentServiceInterface', function () {
            return new PaymentService();
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
