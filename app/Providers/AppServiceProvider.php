<?php

namespace App\Providers;

use App\Services\Address\AddressService;
use App\Services\Address\AddressServiceInterface;
use App\Services\Campaign\CampaignService;
use App\Services\Campaign\CampaignServiceInterface;
use App\Services\Checkout\CheckoutService;
use App\Services\Checkout\CheckoutServiceInterface;
use App\Services\Company\CompanyService;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Document\DocumentService;
use App\Services\Document\DocumentServiceInterface;
use App\Services\File\FileService;
use App\Services\File\FileServiceInterface;
use App\Services\Ingredient\IngredientService;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\Notification\NotificationService;
use App\Services\Notification\NotificationServiceInterface;
use App\Services\Order\OrdersService;
use App\Services\Order\OrdersServiceInterface;
use App\Services\Pages\PagesService;
use App\Services\Pages\PagesServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Search\SearchService;
use App\Services\Search\SearchServiceInterface;
use App\Services\Equipment\EquipmentService;
use App\Services\Equipment\EquipmentServiceInterface;
use App\Services\Stripe\Account\StripeAccountService;
use App\Services\Stripe\Account\StripeAccountServiceInterface;
use App\Services\Stripe\BillingPortal\BillingPortalService;
use App\Services\Stripe\BillingPortal\BillingPortalServiceInterface;
use App\Services\Stripe\Customer\CustomerService;
use App\Services\Stripe\Customer\CustomerServiceInterface;
use App\Services\Stripe\Payment\PaymentService;
use App\Services\Stripe\Payment\PaymentServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AddressServiceInterface::class, AddressService::class);
        $this->app->bind(BillingPortalServiceInterface::class, BillingPortalService::class);
        $this->app->bind(CheckoutServiceInterface::class, CheckoutService::class);
        $this->app->bind(CompanyServiceInterface::class, CompanyService::class);
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(FileServiceInterface::class, FileService::class);
        $this->app->bind(IngredientServiceInterface::class, IngredientService::class);
        $this->app->bind(NotificationServiceInterface::class, NotificationService::class);
        $this->app->bind(OrdersServiceInterface::class, OrdersService::class);
        $this->app->bind(PagesServiceInterface::class, PagesService::class);
        $this->app->bind(PaymentServiceInterface::class, PaymentService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(SearchServiceInterface::class, SearchService::class);
        $this->app->bind(StripeAccountServiceInterface::class, StripeAccountService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(EquipmentServiceInterface::class, EquipmentService::class);
        $this->app->bind(DocumentServiceInterface::class, DocumentService::class);
        $this->app->bind(CampaignServiceInterface::class, CampaignService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::forceScheme('https');
    }
}
