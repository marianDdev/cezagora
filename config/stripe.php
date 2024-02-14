<?php

return [
    'payment_intent_webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
    'publishable'                   => env('PUBLISHABLE_KEY'),
    'secret'                        => env('STRIPE_SECRET'),
];
