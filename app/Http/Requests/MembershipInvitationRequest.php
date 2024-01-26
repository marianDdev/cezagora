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
            'invitation.xlsx' => 'required|file|mimetypes:xlsx,xls,csv'
        ];
    }
}
