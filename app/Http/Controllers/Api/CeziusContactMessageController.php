<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CeziusContactMessageController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validated();
        ContactMessage::create($validated);

        return new JsonResponse(['message: success']);
    }
}
