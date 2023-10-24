<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
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
        return $this->pendingOrder;
    }

    /**
     * @throws Exception
     */
    public function createOrderItem(array $validated): OrderItem
    {
        $order     = $this->getCurrentOrder();
        $data      = array_merge($validated, ['order_id' => $order->id]);
        $item      = OrderItem::create($data);

        if (is_null($item)) {
            throw new Exception('Order item was not created', 422);
        }

        $item->total = $item->price * $item->quantity;
        $item->save();

        $this->updateTotal($order, $item);

        return $item;
    }

    public function updateTotal(Order $order, OrderItem $item): void
    {
        $order->total_price += $item->total;
        $order->save();
    }
}
