<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handlePaymentIntentSucceeded(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
    }

    public function handleTransfers(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
    }
}
