<?php

namespace App\Services\Checkout;

use Illuminate\Support\Collection;

class CheckoutService implements CheckoutServiceInterface
{

    public function prepareCheckoutData(Collection $cartItems, int $orderId, ?int $feePercentage = 0): array
    {
        $lineItems = [];
        $productIds = [];
        $total = 0;

        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency'     => 'ron',
                    'unit_amount'  => $item->price,
                    'product_data' => [
                        'name' => $item->name,
                    ],
                ],
                'quantity'   => $item->quantity,
            ];

            $productIds[] = $item->id;

            $total += $item->price * $item->quantity;
        }

        return [
            'mode'                => self::PAYMENT_MODE,
            'line_items'          => $lineItems,
            'payment_intent_data' => [
                'application_fee_amount' => $total * $feePercentage / 100,
            ],
            'success_url'         => route('checkout.success'),
            'cancel_url'          => route('ingredients'),
            'metadata'            => [
                'order_id' => implode(',', $productIds),
            ],
        ];
    }
}
