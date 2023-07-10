<?php

namespace App\Http\Controllers;

use App\Models\CompanyCategory;
use App\Models\ProductsCategory;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
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

    public function dashboard(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $company            = $user->company;
        $companyBusinessMap = [
            CompanyCategory::MANUFACTURER         => $company->products ?? null,
            CompanyCategory::RETAILER             => $company->products ?? null,
            CompanyCategory::INGREDIENTS_SUPPLIER => $company->ingredients ?? null,
        ];

        $companyBusinesstextMap = [
            CompanyCategory::MANUFACTURER         => 'My products',
            CompanyCategory::RETAILER             => 'My products',
            CompanyCategory::INGREDIENTS_SUPPLIER => 'ingredients',
        ];

        return view('dashboard', [
            'user'    => $user,
            'company' => $company ?? null,
            'text'    => $company && $company->companyCategory
                ? $companyBusinesstextMap[$company->companyCategory->name]
                : '',
            'items'   => $company && $company->companyCategory
                ? $companyBusinessMap[$company->companyCategory->name]
                : null,
        ]);
    }
}
