<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'seller_id' => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'status' => ['required', 'string', Rule::in(Order::getStatuses())],
            'total_price' => ['required', 'integer'],
        ];
    }
}
