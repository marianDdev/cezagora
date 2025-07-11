<?php

namespace App\Http\Requests;

use App\Models\CompanyCategory;
use App\Services\User\UserServiceInterface;
use App\Traits\AuthUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreCompanyRequest extends FormRequest
{
    use AuthUser;

    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * don't add Rule::exist() to company_category_id because we let the user add a new category if none from the existing ones is his category
     */
    public function rules(): array
    {
        $isRequired = $this->authUser()->hasRole(UserServiceInterface::ROLE_SELLER) ? 'required' : 'nullable';

        return [
            'company_categories'   => [$isRequired, 'array'],
            'company_categories.*' => [$isRequired, 'int', Rule::exists(CompanyCategory::class, 'id')],
            'tax_id'               => [$isRequired, 'string'],
            'vat_id'               => [$isRequired, 'string'],
            'mcc'                  => [$isRequired, 'string'],
            'name'                 => ['required', 'string', 'max:256'],
            'email'                => ['required', 'email', 'unique:companies'],
            'phone'                => ['required', 'regex:/^(?:\+|\b00)[1-9]\d{8,}$/'],
            'country'              => ['required', 'string', 'max:256'],
            'city'                 => ['required', 'string', 'max:256'],
            'state'                => ['nullable', 'string', 'max:256'],
            'product_description'  => ['nullable', 'string'],
            'website'              => ['nullable', 'url'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Phone number format is invalid. Add country prefix without parentheses, dashes, or dots.',
        ];
    }
}
