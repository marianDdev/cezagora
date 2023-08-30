<?php

namespace App\Http\Controllers;

use App\Models\CompanyCategory;
use App\Models\MerchantCategoryCode;
use App\Models\ProductsCategory;
use App\Services\Pages\PagesServiceInterface;
use App\Services\Stripe\Account\StripeAccountServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;

class PagesController extends Controller
{
    use AuthUser;

    public function home(): View
    {
        return view(
            'pages.home.main',
            [
                'categories' => ProductsCategory::all(),
            ]
        );
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function help(): View
    {
        return view('pages.help');
    }

    public function pricing(): View
    {
        return view('pages.pricing');
    }

    public function dashboard(
        StripeAccountServiceInterface $stripeAccountService,
        PagesServiceInterface         $pagesService
    ): View
    {
        $categories = [
            'categories' => CompanyCategory::all(),
            'mccs'       => MerchantCategoryCode::all(),
        ];
        $data       = array_merge($categories, $pagesService->getDashboardData($stripeAccountService));

        return view('pages.dashboard', $data);
    }
}
