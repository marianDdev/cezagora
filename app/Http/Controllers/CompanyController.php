<?php

namespace App\Http\Controllers;

use App\Events\CompanyCreated;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\CompanyIngredient;
use App\Models\MerchantCategoryCode;
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
        return view('companies.index', ['companies' => Company::all()]);
    }

    public function show(string $slug): View
    {
        $company = Company::where('slug', $slug)->first();

        if (is_null($company)) {
            abort(404, 'Company not found.');
        }

        $companyIngredients = CompanyIngredient::where('company_id', $company->id)->get();

        return view('companies.show', [
            'company' => $company,
            'ingredients' => $companyIngredients ?? null,
            'products' => $company->products ?? null,
            'services' => $company->services ?? null,
        ]);
    }

    public function showMyCompany(): View
    {
        $user = $this->authUser();

        return view('components.companies', ['companies' => $user->company()]);
    }

    public function create(): View
    {
        return view(
            'companies.forms.create',
            [
                'categories' => CompanyCategory::all(),
                'mccs' => MerchantCategoryCode::all()
            ]
        );
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
        $userService->updateCompany($company->id);
        $company->update(['has_details_completed' => true]);

        event(new CompanyCreated($company));

        return redirect('/onboarding');
    }

    public function edit(): View
    {
        $company = $this->authUserCompany();

        return view('companies.forms.edit', ['companies' => $company]);
    }

    public function update()
    {
        //
    }
}
