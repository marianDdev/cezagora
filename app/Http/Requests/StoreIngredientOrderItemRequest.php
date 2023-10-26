<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\OrderItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreIngredientOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'seller_id'   => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'item_id'     => ['required', 'integer'],
            'price'       => ['required', 'integer'],
            'quantity'    => ['required', 'integer'],
            'name'        => ['required', 'string'],
        ];
    }
}
