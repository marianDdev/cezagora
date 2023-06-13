<?php

namespace App\Http\Controllers;

use App\Models\CompanyCategory;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function dashboard(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $company            = $user->company;
        $companyBusinessMap = [
            CompanyCategory::MANUFACTURER         => $company->products,
            CompanyCategory::INGREDIENTS_SUPPLIER => $company->ingredients,
        ];

        $companyBusinesstextMap = [
            CompanyCategory::MANUFACTURER         => 'My products',
            CompanyCategory::INGREDIENTS_SUPPLIER => 'ingredients',
        ];

        return view('dashboard', [
            'user'     => $user,
            'company'  => $company,
            'text'     => $companyBusinesstextMap[$company->companyCategory->name],
            'business' => $companyBusinessMap[$company->companyCategory->name],
        ]);
    }
}
