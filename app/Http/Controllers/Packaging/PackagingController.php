<?php

namespace App\Http\Controllers\Packaging;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackagingRequest;
use App\Models\Packaging;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PackagingController extends Controller
{
    use AuthUser;

    public function index(): View
    {
        $packagings = $this->authUserCompany()->packagings;

        return view('packaging.index', ['packagings' => $packagings]);
    }

    public function create(): View
    {
        return view('packaging.forms.create');
    }
    public function store(StorePackagingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Packaging::create($validated);

        return redirect()->route('my.packagings');
    }
}
