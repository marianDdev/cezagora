<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Services\Qualification\QualificationServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreQualificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'company_id'         => ['required', 'integer', Rule::exists(Company::class, 'id')],
            'type'               => ['required', 'string', Rule::in(QualificationServiceInterface::TYPES)],
            'name'               => ['required', 'string'],
            'issuer'             => ['required', 'string'],
            'certificate_number' => ['required', 'string'],
            'scope'              => ['required', 'string'],
            'url'                => ['nullable', 'string'],
            'verification_link'  => ['required', 'string'],
            'additional_info'    => ['nullable', 'string'],
            'issued_at'          => ['required', 'date', 'before_or_equal:now'],
            'expire_at'          => ['nullable', 'string', 'after_or_equal:now'],
        ];
    }
}
