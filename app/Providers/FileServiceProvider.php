<?php

namespace App\Providers;

use App\Services\File\FileService;
use App\Services\Ingredient\IngredientService;
use App\Services\Product\ProductService;
use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\File\FileServiceInterface', function () {
            return new FileService((new IngredientService), (new ProductService()) );
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
