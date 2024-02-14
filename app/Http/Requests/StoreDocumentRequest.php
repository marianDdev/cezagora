<?php

namespace App\Http\Requests;

use App\Models\Ingredient;
use App\Services\Document\DocumentServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'ingredient_id'  => ['required', 'integer', Rule::exists(Ingredient::class, 'id')],
            'documents'      => ['nullable', 'array'],
            'documents.*'    => ['required_if:documents, true', 'string', Rule::in(DocumentServiceInterface::ALL_DOCUMENTS)],
            'other_document' => ['nullable', 'string'],
        ];
    }
}
