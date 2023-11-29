<?php

namespace App\Http\Requests;

use App\Services\File\FileServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'entity' => ['required', 'string', Rule::in(FileServiceInterface::MODELS)],
        ];
    }
}
