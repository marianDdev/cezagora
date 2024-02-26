<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliveryAddressRequest;
use App\Models\DeliveryAddress;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DeliveryAddressController extends Controller
{
    public function create(): View
    {
        return view('addresses.delivery.create');
    }

    public function store(StoreDeliveryAddressRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        DeliveryAddress::create($validated);

        return redirect()->route('dashboard');
    }
}
