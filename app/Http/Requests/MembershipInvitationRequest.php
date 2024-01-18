<?php

namespace App\Http\Requests;

use App\Rules\EmailCompanyFormat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MembershipInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'email_company_pairs' => ['required', 'string', new EmailCompanyFormat()],
        ];
    }
}
