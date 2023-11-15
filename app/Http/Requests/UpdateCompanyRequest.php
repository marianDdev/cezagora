<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && !is_null(Auth::user()->company);
    }

    public function rules(): array
    {
        return [
            'company_id'          => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'company_categories'  => ['nullable', 'array'],
            'name'                => ['nullable', 'string', 'max:256'],
            'email'               => ['nullable', 'email'],
            'phone'               => ['required', 'regex:/^(?:\+|\b00)[1-9]\d{8,}$/'],
            'country'             => ['nullable', 'string', 'max:256'],
            'city'                => ['nullable', 'string', 'max:256'],
            'state'               => ['nullable', 'string', 'max:256'],
            'product_description' => ['nullable', 'string'],
            'website'             => ['nullable', 'url'],
            'tax_id'              => ['nullable', 'string', 'min:8', 'max:10'],
            'vat_id'              => ['nullable', 'string'],
            'mcc'                 => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Phone number format is invalid. Add country prefix without parentheses, dashes, or dots.',
        ];
    }
}
