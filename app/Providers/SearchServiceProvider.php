<?php

namespace App\Providers;

use App\Services\SearchService;
use App\Services\SearchServiceInterface;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SearchServiceInterface::class, SearchService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
