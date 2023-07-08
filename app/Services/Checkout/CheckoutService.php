<?php

namespace App\Services\Checkout;

use Illuminate\Support\Collection;

class CheckoutService implements CheckoutServiceInterface
{

    public function prepareCheckoutData(Collection $cartItems, ?int $fee = 0): array
    {
        $lineItems        = [];
        $stripeAccountIds = [];

        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency'     => 'eur',
                    'unit_amount'  => $item->price,
                    'product_data' => [
                        'name' => $item->name,
                    ],
                ],
                'quantity'   => $item->quantity,
            ];

            $stripeAccountIds['stripe_account'] = $item->company->user->stripe_account_id;
        }

        $data = [
            'mode'                => self::PAYMENT_MODE,
            'line_items'          => $lineItems,
            'payment_intent_data' => [
                'application_fee_amount' => $fee,
            ],
            'success_url'         => route('checkout.success'),
            'cancel_url'          => route('ingredients'),
            'metadata'            => [
                'cart_items' => $cartItems,
            ],
        ];

        return [
            'data'               => $data,
            'stripe_account_ids' => $stripeAccountIds,
        ];
    }
}
