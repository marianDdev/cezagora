<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    public function listServices(): View
    {
        $company = $this->authUserCompany();
        $services = $company->services()->orderByDesc('created_at')->paginate(12);

        return view(
            'packaging.my_packaging',
            [
                'services' => $services,
                'company'     => $company,
            ]
        );
    }

    public function create(): View
    {
        $company = $this->authUserCompany();

        return view(
            'services.forms.create',
            [
                'company' => $company,
            ]
        );
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Service::create($validated);

        return redirect()->route('dashboard');
    }
}
