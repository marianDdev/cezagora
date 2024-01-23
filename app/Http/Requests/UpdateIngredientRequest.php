<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Ingredient;
use App\Services\Document\DocumentServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateIngredientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'company_id'     => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'id'             => ['required', 'integer', Rule::exists(Ingredient::class, 'id')],
            'name'           => ['nullable', 'string'],
            'common_name'    => ['nullable', 'string'],
            'description'    => ['nullable', 'string'],
            'function'       => ['nullable', 'string'],
            'price'          => ['nullable', 'integer'],
            'quantity'       => ['nullable', 'integer', 'max:99999'],
            'documents'      => ['nullable', 'array'],
            'documents.*'    => ['required_if:documents, true', 'string'],
            'other_document' => ['nullable', 'string'],
        ];
    }
}
