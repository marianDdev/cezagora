<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Services\Equipment\EquipmentServiceInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreEquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'company_id'      => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'type'            => ['required', 'string', Rule::in(EquipmentServiceInterface::TYPES)],
            'name'            => ['required', 'string'],
            'description'     => ['nullable', 'string'],
            'price'           => ['required', 'integer', 'min:1'],
            'additional_info' => ['nullable', 'string'],
            'quantity'        => ['required', 'integer', 'max:99999'],
            'availability'    => ['required', 'string', Rule::in(EquipmentServiceInterface::AVAILABILITY_TYPES)],
            'available_at'    => ['required_if:availability,on_demand', 'date', 'after_or_equal:' . Carbon::today()],

        ];
    }
}
