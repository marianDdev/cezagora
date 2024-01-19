<?php

namespace App\Http\Controllers;

use App\Services\Pages\PagesServiceInterface;
use App\Services\Stripe\Account\StripeAccountServiceInterface;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(
        StripeAccountServiceInterface $stripeAccountService,
        PagesServiceInterface         $pagesService,
    ): View
    {
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
