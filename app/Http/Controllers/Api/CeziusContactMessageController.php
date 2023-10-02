<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Models\CeziusContactMessage;
use Illuminate\Http\JsonResponse;

class CeziusContactMessageController extends Controller
{
    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        $validated = $request->validated();
        CeziusContactMessage::create($validated);

        return new JsonResponse(['message: success']);
    }
}
