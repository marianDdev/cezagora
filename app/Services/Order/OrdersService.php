<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Traits\AuthUser;

class OrdersService implements OrdersServiceInterface
{
    use AuthUser;

    public function getCurrentOrder(array $validated): ?Order
    {
        $order = Order::where('customer_id', $this->authUserCompany()->id)
                      ->where('status', Order::STATUS_PENDING)
                      ->first();

        if (is_null($order)) {
            return Order::create(
                [
                    'customer_id' => $this->authUserCompany()->id,
                    'seller_id' => $validated['seller_id'],
                ]
            );
        }

        return $order;
    }
}
