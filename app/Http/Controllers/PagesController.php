<?php

namespace App\Http\Controllers;

use App\Models\CompanyCategory;
use App\Models\ProductsCategory;
use App\Models\User;
use App\Services\Pages\PagesServiceInterface;
use App\Services\Stripe\Account\StripeAccountServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    use AuthUser;

    public function home(): View
    {
        return view('pages.home', ['categories' => ProductsCategory::all()]);
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

    public function services(): View
    {
        return view('pages.services');
    }

    public function dashboard(
        StripeAccountServiceInterface $stripeAccountService,
        PagesServiceInterface         $pagesService
    ): View
    {

        $data = $pagesService->getDashboardData($stripeAccountService);

        return view('dashboard', $data);
    }
}
