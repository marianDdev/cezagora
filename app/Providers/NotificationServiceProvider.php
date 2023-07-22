<?php

namespace App\Providers;

use App\Services\Notification\NotificationService;
use Illuminate\Support\ServiceProvider;
use Spatie\SlackAlerts\SlackAlert;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Services\Notification\NotificationServiceInterface', function () {
            return new NotificationService(new SlackAlert());
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
