<?php

namespace App\Services\Stripe\Customer;

use App\Models\Order;
use App\Models\User;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;

interface CustomerServiceInterface
{
    /**
     * @throws ApiErrorException
     */
    public function create(Order $order): Customer;

    public function createCustomer(User $user): Customer;
}
