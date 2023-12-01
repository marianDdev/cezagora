<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\AuthUser;
use Exception;

class OrdersService implements OrdersServiceInterface
{
    use AuthUser;

    /**
     * @throws Exception
     */
    public function createOrderItem(array $validated): OrderItem
    {
        $order = $this->getCurrentOrder();
        $data  = $this->getItemData($order, $validated);
        $item  = $this->createItem($data);

        $this->increaseTotal($order, $item);

        return $item;
    }

    public function deleteItem(OrderItem $item): void
    {
        $order = $item->order;
        $itemTotal = $item->total;
        $item->delete();

        if ($order->items->count() === 0) {
            $order->delete();
        } else {
            $orderTotal = $order->total_price - $itemTotal;
            $order->update(['total_price' => $orderTotal]);
        }
    }

    public function getPendingOrder(): ?Order
    {
        return Order::where('customer_id', $this->authUserCompany()->id)
                    ->where('status', Order::STATUS_PENDING)
                    ->first();
    }

    private function increaseTotal(Order $order, OrderItem $item): void
    {
        $order->total_price += $item->total;
        $order->save();
    }

    private function getCurrentOrder(): ?Order
    {
        $order = $this->getPendingOrder();

        if (is_null($order)) {
            return Order::create(
                [
                    'customer_id' => $this->authUserCompany()->id,
                ]
            );
        }

        return $order;
    }

    private function getItemData(Order $order, array $validated): array
    {
        return array_merge(
            $validated, [
                          'item_type' => OrderItem::INGREDIENT_TYPE,
                          'order_id'  => $order->id,
                          'total'     => $validated['price'] * $validated['quantity'],
                      ]
        );
    }

    private function createItem(array $data): OrderItem
    {
        $item = OrderItem::create($data);

        if (is_null($item)) {
            throw new Exception('Order item was not created', 422);
        }

        $item->total = $item->price * $item->quantity;
        $item->save();

        return $item;
    }
}
