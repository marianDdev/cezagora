<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        //don't add Rule::exist() to company_category_id because we let the user add a new category
        // if none from the existing ones is his category
        return [
            'company_category_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:256'],
            'email'      => ['required', 'email', 'unique:companies'],
            'phone'      => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'country' => ['required', 'string', 'max:256'],
            'city' => ['required', 'string', 'max:256'],
            'state' => ['nullable', 'string', 'max:256'],
            'product_description' => ['nullable', 'string'],
            'website' => ['nullable', 'url'],
            'tax_id' => ['required', 'string'],
            'vat_id' => ['required', 'string'],
            'mcc' => ['required', 'string']
        ];
    }
}
