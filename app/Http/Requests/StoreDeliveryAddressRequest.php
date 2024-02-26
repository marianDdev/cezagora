<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeliveryAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'company_id'     => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'country_code'   => ['required', 'string'],
            'zipcode'        => ['required', 'string'],
            'city'           => ['required', 'string'],
            'cityId'         => ['required', 'integer'],
            'street'         => ['required', 'string'],
            'additionalInfo' => ['nullable', 'string'],
            'region'         => ['required', 'string'],
            'regionCode'     => ['required', 'string'],
            'regionId'       => ['required', 'integer'],
            'timezone'       => ['required', 'string'],
            'customFields'   => ['nullable', 'array'],
        ];
    }
}
