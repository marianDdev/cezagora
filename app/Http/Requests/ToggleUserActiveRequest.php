<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ToggleUserActiveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'activate' => ['required', 'boolean'],
            'deleted_at' => ['nullable', 'date']
        ];
    }
}
