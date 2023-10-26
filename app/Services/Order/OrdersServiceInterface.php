<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;

interface OrdersServiceInterface
{
    public function getPendingOrder(): ?Order;

    public function createOrderItem(array $validated): OrderItem;

    public function updateTotal(Order $order, OrderItem $item): void;
}
