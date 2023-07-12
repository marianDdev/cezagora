<?php

namespace App\Listeners;

use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class CreateStripeAccount
{
    private StripeClient $stripeClient;

    /**
     * Create the event listener.
     */
    public function __construct(StripeClient $stripeClient)
    {
        $this->stripeClient = $stripeClient;
    }

    /**
     * Handle the event.
     *
     * @throws ApiErrorException
     */
    public function handle(object $event): void
    {
        $response = $this->stripeClient->accounts->create(
            [
                'type' => 'standard',
            ],
            [
                'api_key' => config('stripe.secret'),
            ]
        );

        $event->user->update(
            [
                'stripe_account_id' => $response->id,
            ]
        );
    }
}
