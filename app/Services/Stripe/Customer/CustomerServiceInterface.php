<?php

namespace App\Services\Stripe\Customer;

use App\Models\Address;
use App\Models\Company;
use App\Models\Order;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;

interface CustomerServiceInterface
{
    /**
     * @throws ApiErrorException
     */
    public function create(Order $order): Customer;
}
