<?php

namespace App\Http\Controllers\Company;

use App\Events\CompanyCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\Address\AddressServiceInterface;
use App\Services\Company\CompanyServiceInterface;
use App\Services\File\FileServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Traits\AuthUser;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use AuthUser;

    public function index(): View
    {
        return view(
            'companies.index',
            [
                'companies' => Company::all(),
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
            'company'     => $company,
            'ingredients' => $company->ingredients ?? null,
            'products'    => $company->products ?? null,
            'services'    => $company->services ?? null,
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
    ): RedirectResponse|View
    {
        try {
            $validated = $request->validated();
            $company   = $companyService->create($validated);
            $addressService->create($validated, $company->id);
            $userService->setCompany($company->id);
            $company->update(['has_details_completed' => true]);

            event(new CompanyCreated($company));

            if ($this->authUser()->hasRole(UserServiceInterface::ROLE_SELLER)) {
                return redirect()->route('onboarding');
            }

            return redirect()->route('dashboard');
        } catch (Exception $e) {
            return view('companies.fail', ['error' => $e]);
        }
    }

    public function update(UpdateCompanyRequest $request, CompanyServiceInterface $companyService): RedirectResponse
    {
        $validated = $request->validated();
        $companyService->update($validated);

        return redirect()->route('dashboard');
    }

    public function uploadLogo(Request $request, FileServiceInterface $fileService): RedirectResponse
    {
        try {
            $fileService->uploadCompanyLogo($request);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error_message' => $e->getMessage()]);
        }

        return redirect()->back()->with('success', 'Profile image uploaded successfully.');
    }
}
