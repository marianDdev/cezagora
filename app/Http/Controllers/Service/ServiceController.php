<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(12);

        return view('services.index', ['services' => $services]);
    }

    public function listMyServices(): View
    {
        $company = $this->authUserCompany();
        $services = $company->services()->orderByDesc('created_at')->paginate(12);

        return view('services.my_services', ['services' => $services, 'company' => $company]);
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

        return redirect()->route('my_services');
    }
}
