<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role'       => ['required', 'string', Rule::exists(Role::class, 'name')],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users'],
            'is_admin'   => ['nullable', 'boolean'],
            'password'   => ['required', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@()$%^&*=_{}[\]:;"\'|\\<>,.\/~`±§+-]).{8,30}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.regex' => 'The :attribute must be 8–30 characters, and include a number, a symbol, a lower and a upper case letter',
        ];
    }
}
