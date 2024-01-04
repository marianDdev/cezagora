<?php

namespace App\Providers;

use App\Events\CompanyCreated;
use App\Events\IngredientsFileProcessed;
use App\Events\OrderCreated;
use App\Listeners\AdjustIngredientsQuantity;
use App\Listeners\CreateCompanyCampaign;
use App\Listeners\CreateStripeAccount;
use App\Listeners\CreateStripeCustomer;
use App\Listeners\SendCustomerChargedEmail;
use App\Listeners\UpdateOrderStatus;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class               => [
            SendEmailVerificationNotification::class,
        ],
        CompanyCreated::class           => [
            CreateStripeAccount::class,
            CreateStripeCustomer::class,
            CreateCompanyCampaign::class,
        ],
        OrderCreated::class => [
            AdjustIngredientsQuantity::class,
            SendCustomerChargedEmail::class,
            UpdateOrderStatus::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
