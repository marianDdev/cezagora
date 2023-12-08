<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLaboratoryRequest;
use App\Models\Laboratory;
use App\Models\PackagingCategory;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LaboratoryController extends Controller
{
    use AuthUser;

    public function listMyLabServices(): View
    {
        $company = $this->authUserCompany();
        $labServices = $company->labServices()->orderByDesc('created_at')->paginate(12);

        return view(
            'packaging.my_packaging',
            [
                'labServices' => $labServices,
                'company'     => $company,
            ]
        );
    }

    public function create(): View
    {
        $company = $this->authUserCompany();

        return view(
            'lab_services.forms.create',
            [
                'company' => $company,
            ]
        );
    }

    public function store(StoreLaboratoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Laboratory::create($validated);

        return redirect()->route('dashboard');
    }
}
