<?php

namespace App\Providers;

use App\Services\Ingredient\ProductService;
use Illuminate\Support\ServiceProvider;

class IngredientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\Ingredient\IngredientServiceInterface', function () {
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
