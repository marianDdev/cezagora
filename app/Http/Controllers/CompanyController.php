<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\CompanyCategory;
use App\Services\AddressServiceInterface;
use App\Services\CompanyServiceInterface;
use App\Services\UserServiceInterface;
use Exception;
use Illuminate\Contracts\View\View;

class CompanyController extends Controller
{
    public function create(): View
    {
        return view('forms.company.create', ['categories' => CompanyCategory::all()]);
    }

    public function store(
        StoreCompanyRequest     $request,
        CompanyServiceInterface $companyService,
        AddressServiceInterface $addressService,
        UserServiceInterface    $userService
    )
    {
        try {
            $validated = $request->validated();
            $company = $companyService->create($validated);
            $addressService->create($validated, $company->id);
            $userService->updateCompany($company->id);

            //return redirect('/dashboard');

            return response()->json('succes', 204);

        } catch (Exception $e) {
            return response()->json($e->getMessage());
//            return redirect('/')->with(
//                'status',
//                sprintf('Coud not create company. Got this error: %s', $e->getMessage())
//            );
        }
    }
}
