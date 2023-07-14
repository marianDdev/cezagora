<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Traits\AuthUser;
use Exception;

class OrdersService implements OrdersServiceInterface
{
    use AuthUser;


    private ?Order $pendingOrder;

    public function __construct()
    {
        $this->pendingOrder = Order::where('customer_id', $this->authUserCompany()->id)
                                   ->where('status', Order::STATUS_PENDING)
                                   ->first();
    }

    public function getCurrentOrder(): ?Order
    {
        $order = $this->pendingOrder;

        if (is_null($order)) {
            return Order::create(
                [
                    'customer_id' => $this->authUserCompany()->id,
                ]
            );
        }

        return $order;
    }

    /**
     * @throws Exception
     */
    public function getPendingOrder(): Order
    {
        if (is_null($this->pendingOrder)) {
            throw new Exception('there is no pending order.');
        }

        return $this->pendingOrder;
    }
}
