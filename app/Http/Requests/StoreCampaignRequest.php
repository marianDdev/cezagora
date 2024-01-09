<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCampaignRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['string', 'required', 'unique:campaigns'],
            'start_at' => ['date', 'required', 'after_or_equal:' . Carbon::today()],
            'end_at'   => ['date', 'nullable', 'after:start_at'],
            'limit'    => ['integer', 'min:1'],
        ];
    }
}
