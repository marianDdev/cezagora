<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\User;
use App\Services\Service\EquipmentServiceInterface;
use App\Services\Service\ServicesServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreServiceRequest extends FormRequest
{

    public function authorize(): bool
    {
        /** @var User $user */
        $user = Auth::user();

        return !is_null($user->company);
    }

    public function rules(): array
    {
        return [
            'company_id'      => ['required', 'int', Rule::exists(Company::class, 'id')],
            'type'            => ['required', Rule::in(ServicesServiceInterface::TYPES)],
            'name'            => ['required', 'string'],
            'description'     => ['required', 'string'],
            'price'           => ['required', 'integer', 'min:1'],
            'additional_info' => ['nullable', 'string'],
        ];
    }
}
