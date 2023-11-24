<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Services\Ingredient\IngredientServiceInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreIngredientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'name' => ['required', 'string'],
            'common_name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'function' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'max:99999'],
            'availability' => ['required', 'string', Rule::in(IngredientServiceInterface::AVAILABILITY_TYPES)],
            'available_at' => ['required_if:availability,on_demand', 'date', 'after_or_equal:' . Carbon::today()]
        ];
    }
}
