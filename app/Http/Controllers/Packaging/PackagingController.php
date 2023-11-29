<?php

namespace App\Http\Controllers\Packaging;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackagingRequest;
use App\Models\Packaging;
use App\Models\PackagingCategory;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PackagingController extends Controller
{
    use AuthUser;

    public function index(): View
    {
        return view('packaging.index', ['packagings' => Packaging::all()]);
    }

    public function listMyPackaging(): View
    {
        $company    = $this->authUserCompany();
        $packaging  = $company->packagings()->orderByDesc('created_at')->paginate(12);
        $categories = PackagingCategory::all();

        return view(
            'packaging.my_packaging',
            [
                'packagings' => $packaging,
                'company'    => $company,
                'categories' => $categories,
            ]
        );
    }

    public function create(): View
    {
        $company    = $this->authUserCompany();
        $categories = PackagingCategory::all();

        return view(
            'packaging.forms.create',
            [
                'company'    => $company,
                'categories' => $categories,
            ]
        );
    }

    public function store(StorePackagingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Packaging::create($validated);

        return redirect()->route('my-packaging');
    }
}
