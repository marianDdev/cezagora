<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Models\Equipment;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EquipmentController extends Controller
{
    use AuthUser;
    public function index(): View
    {
        $equipments = Equipment::orderBy('created_at', 'desc')->paginate(12);

        return view('equipment.index', ['equipments' => $equipments]);
    }

    public function listMyEquipment(): View
    {
        $company = $this->authUserCompany();
        $equipments = $company->equipments()->orderByDesc('created_at')->paginate(12);

        return view('equipment.my_equipment', ['equipments' => $equipments]);
    }

    public function create(): View
    {
        $company = $this->authUserCompany();

        return view('equipment.forms.create', ['company' => $company]);
    }

    public function store(StoreEquipmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Equipment::create($validated);

        return redirect()->route('my_equipment');
    }
}
