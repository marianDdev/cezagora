<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQualificationRequest;
use App\Models\Company;
use App\Models\Qualification;
use App\Traits\AuthUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class QualificationController extends Controller
{
    use AuthUser;

    public function listByCompanyId(int $companyId)
    {
        $company = Company::find($companyId);
        $qualifications = $company->qualifications;
    }

    public function create(): View
    {
        return view('qualifications.create');
    }

    public function store(StoreQualificationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Qualification::create($validated);

        return redirect()->route('my-qualifications');
    }

    public function showMyQualifications(): View
    {
        $qualifications = $this->authUserCompany()->qualifications;

        return view('qualifications.my_qualifications', ['qualifications' => $qualifications]);
    }
}
