<?php

namespace App\Providers;

use App\Services\Ingredient\ProductService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {$this->app->bind('App\Services\Product\ProductServiceInterface', function () {
        return new ProductService();
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
