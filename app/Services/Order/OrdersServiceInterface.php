<?php

namespace App\Services\Order;

use App\Models\Order;

interface OrdersServiceInterface
{
    public function getCurrentOrder(array $validated): ?Order;
}
