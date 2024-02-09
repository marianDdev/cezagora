<?php

namespace App\Http\Controllers;

use App\Services\Pages\PagesServiceInterface;
use App\Services\Stripe\Account\StripeAccountServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    use AuthUser;

    public function index(
        StripeAccountServiceInterface $stripeAccountService,
        PagesServiceInterface         $pagesService,
    ): View
    {
        if ($this->authUser()->hasRole(UserServiceInterface::ROLE_ADMIN)) {
            return view('admin.index');
        }

        return view('dashboard.index', $pagesService->getDashboardData($stripeAccountService));
    }

    public function showMyProductsAndServices(PagesServiceInterface $service): View
    {
        $data = $service->getProductAndServicesData();

        return view('dashboard.products_and_services.index', $data);
    }

    public function showSettings(): View
    {
        return view('pages.settings');
    }
}
