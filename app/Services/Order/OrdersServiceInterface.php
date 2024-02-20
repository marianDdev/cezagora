<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Carrier\CarrierServiceInterface;

interface OrdersServiceInterface
{
    public function getPendingOrder(): ?Order;

    public function createOrderItem(array $validated, CarrierServiceInterface $carrierService): OrderItem;

    public function deleteItem(OrderItem $item): void;
}
