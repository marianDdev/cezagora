<?php

namespace App\Services\Stripe;

use Stripe\StripeClient;

abstract class StripeService
{
    protected StripeClient $stripeClient;

    public function __construct()
    {
        $this->stripeClient = new StripeClient(config('stripe.secret'));
    }
}
