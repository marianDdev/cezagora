<?php

namespace App\Services\Order;

use App\Models\Company;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Carrier\CarrierServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Traits\AuthUser;
use Exception;

class OrdersService implements OrdersServiceInterface
{
    use AuthUser;

    /**
     * @throws Exception
     */
    public function createOrderItem(array $validated, CarrierServiceInterface $carrierService): OrderItem
    {
        $order = $this->getCurrentOrder();
        $data  = $this->getItemData($order, $validated);
        $item  = $this->createItem($data);
        $this->increaseTotalPrice($order, $data);
        $this->increaseTotalWeight($order, $data);

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

    private function increaseTotalPrice(Order $order, array $data): void
    {
        $order->total_price += $data['quantity'] * $data['price'];
        $order->save();
    }

    private function increaseTotalWeight(Order $order, array $data): void
    {
        $weight = $data['weight'];
        if (in_array($data['unit'], IngredientServiceInterface::VARIANT_UNITS_MACRO)) {
            $weight = $weight * 1000;
        }

        $order->total_weight += $weight * $data['quantity'];
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
                          'weight'    => $validated['weight'],
                      ]
        );
    }

    private function createItem(array $data): OrderItem
    {
        $existingItem = $this->getExitingOrderItem($data);
        $item         = $existingItem ?? OrderItem::create($data);
        if (!is_null($existingItem)) {
            $existingItem->quantity += $data['quantity'];
            $existingItem->save();
        }

        $item->total = $item->price * $item->quantity;
        $item->save();

        return $item;
    }

    private function getExitingOrderItem(array $data): ?OrderItem
    {
        return OrderItem::where(
            [
                'item_type' => $data['item_type'],
                'order_id'  => $data['order_id'],
                'seller_id' => $data['seller_id'],
                'item_id'   => $data['item_id'],
                'price'     => $data['price'],
                'name'      => $data['name'],
            ]
        )->first();
    }
}
