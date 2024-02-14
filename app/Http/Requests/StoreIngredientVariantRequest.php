<?php

namespace App\Http\Requests;

use App\Models\Ingredient;
use App\Services\Ingredient\IngredientServiceInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreIngredientVariantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'ingredient_id' => ['required', 'integer', Rule::exists(Ingredient::class, 'id')],
            'unit'          => ['required', 'string', Rule::in(['gr', 'kg', 'ml', 'l'])],
            'price'         => ['required', 'integer'],
            'size'          => ['required', 'integer'],
            'quantity'      => ['required', 'integer', 'max:99999'],
            'availability'  => ['required', 'string', Rule::in(IngredientServiceInterface::AVAILABILITY_TYPES)],
            'available_at'  => ['required_if:availability,on_demand', 'date', 'after_or_equal:' . Carbon::today()],
            'button_name'   => ['required', 'string', Rule::in(['add_another', 'finish'])],
        ];
    }
}
