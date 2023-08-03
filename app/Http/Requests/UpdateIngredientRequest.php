<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateIngredientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'common_name' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'function' => ['required', 'string'],
            'slug' => ['required', 'string'],
        ];
    }
}
