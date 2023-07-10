<?php

namespace App\Services\Checkout;

use Illuminate\Support\Collection;

class CheckoutService implements CheckoutServiceInterface
{

    public function prepareCheckoutData(Collection $cartItems, ?int $fee = 0): array
    {
        $lineItems = [];
        $productIds = [];

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

            $productIds[] = $item->id;

        }

        return [
            'mode'                => self::PAYMENT_MODE,
            'line_items'          => $lineItems,
            'payment_intent_data' => [
                'application_fee_amount' => $fee,
            ],
            'success_url'         => route('checkout.success'),
            'cancel_url'          => route('ingredients'),
            'metadata'            => [
                'product_id' => implode(',', $productIds),
            ],
        ];
    }
}
