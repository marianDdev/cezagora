<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreLaboratoryRequest extends FormRequest
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
            'company_id'           => ['required', 'int', Rule::exists(Company::class, 'id')],
            'name'                 => ['required', 'string'],
            'description'          => ['required', 'string'],
            'testing_capabilities' => ['nullable', 'string'],
            'specializations'      => ['nullable', 'string'],
            'accreditations'       => ['nullable', 'string'],
            'certifications'       => ['nullable', 'string'],
            'equipment'            => ['nullable', 'string'],
            'operating_hours'      => ['nullable', 'string'],
            'price'                => ['required', 'integer', 'min:1'],
        ];
    }
}
