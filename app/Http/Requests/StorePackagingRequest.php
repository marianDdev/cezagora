<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\PackagingCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StorePackagingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'company_id'            => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'packaging_category_id' => ['required', 'integer', Rule::exists(PackagingCategory::class, 'id')],
            'name'                  => ['required', 'string'],
            'description'           => ['required', 'string'],
            'price'                 => ['required', 'integer', 'min:1'],
            'capacity'              => ['required', 'integer', 'min:1'],
            'colour'                => ['required', 'string'],
            'material'              => ['required', 'string'],
            'neck_size'             => ['nullable', 'integer', 'min:1',],
            'bottom_shape'          => ['nullable', 'string'],
        ];
    }
}
