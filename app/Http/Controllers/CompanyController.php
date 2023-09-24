<?php

namespace App\Http\Controllers;

use App\Events\CompanyCreated;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\Address\AddressServiceInterface;
use App\Services\Company\CompanyServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    use AuthUser;

    public function index(): View
    {
        return view(
            'companies.index',
            [
                'companies' => Company::all()
            ]
        );
    }

    public function show(string $slug): View
    {
        $company = Company::where('slug', $slug)->first();

        if (is_null($company)) {
            abort(404, 'Company not found.');
        }

        return view('companies.show', [
            'company' => $company,
            'ingredients' => $company->ingredients ?? null,
            'products' => $company->products ?? null,
            'services' => $company->services ?? null,
        ]);
    }

    public function showMyCompany(): View
    {
        $user = $this->authUser();

        return view('components.companies', ['companies' => $user->company()]);
    }

    public function store(
        StoreCompanyRequest     $request,
        CompanyServiceInterface $companyService,
        AddressServiceInterface $addressService,
        UserServiceInterface    $userService,
    ): RedirectResponse {
        $validated = $request->validated();
        $company   = $companyService->create($validated);
        $addressService->create($validated, $company->id);
        $userService->setCompany($company->id);
        $company->update(['has_details_completed' => true]);

        event(new CompanyCreated($company));

        return redirect('/onboarding');
    }

    public function update(UpdateCompanyRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        /** @var Company $company */
        $company = Company::find($validated['company_id']);

        if ($request->has('mcc') && $validated['mcc'] === 'Select your merchant category code') {
            $validated['mcc'] = null;
        }

        $company->update($validated);


        //todo choose which address to update or add a new one

        return redirect()->route('dashboard');
    }
}
