<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\CompanyCategory;
use App\Models\User;
use App\Services\AddressServiceInterface;
use App\Services\CompanyServiceInterface;
use App\Services\UserServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function showMyCompany(): View
    {
        /** @var User $user */
        $user = Auth::user();

        return view('components.company', ['company' => $user->company()]);
    }

    public function create(): View
    {
        return view('forms.company.create', ['categories' => CompanyCategory::all()]);
    }

    public function store(
        StoreCompanyRequest     $request,
        CompanyServiceInterface $companyService,
        AddressServiceInterface $addressService,
        UserServiceInterface    $userService
    ): RedirectResponse {
        $validated = $request->validated();
        $company   = $companyService->create($validated);
        $addressService->create($validated, $company->id);
        $userService->updateCompany($company->id);

        return redirect('/dashboard');
    }

    public function edit(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $company = $user->company;

        return view('forms.company.edit', ['company' => $company]);
    }
}
