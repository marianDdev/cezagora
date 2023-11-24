<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Ingredient;
use App\Services\Ingredient\IngredientServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterIngredientsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['nullable', Rule::in(Company::class, 'id')],
            'name' => ['nullable', 'string'],
            'common_name' => ['nullable', 'string'],
            'functions' => ['nullable', 'array'],
            'functions.*' => ['required_if:functions, true', Rule::exists(Ingredient::class, 'function')],
            'min_price' => ['nullable', 'integer', 'min:1'],
            'max_price' => ['nullable', 'integer', 'min:1'],
            'availability' => ['nullable', 'string', Rule::in(IngredientServiceInterface::AVAILABILITY_TYPES)],
            'available_at' => ['required_if:availability, on_demand', 'date']
        ];
    }
}
