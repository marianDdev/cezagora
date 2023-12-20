<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreRatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reviewee_id' => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'reviewer_id' => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'rating'      => ['required', 'integer', 'min:1'],
            'comment'     => ['nullable', 'string'],
        ];
    }
}
