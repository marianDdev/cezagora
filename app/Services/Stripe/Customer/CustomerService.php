<?php

namespace App\Services\Stripe\Customer;

use App\Models\Address;
use App\Models\Company;
use App\Models\Order;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class CustomerService implements CustomerServiceInterface
{

    private StripeClient $stripeClient;

    public function __construct()
    {
        $this->stripeClient = new StripeClient(config('stripe.secret'));
    }

    /**
     * @throws ApiErrorException
     */
    public function create(Order $order): Customer
    {
        $customer = $order->customer;

        /** @var Address $address */
        $address = $customer->addresses->first();

        return $this->stripeClient
            ->customers
            ->create(
                [
                    'address' => [
                        'city'    => $address->city,
                        'country' => $address->country,
                    ],
                    'email'   => $customer->email,
                    'name'    => $customer->name,

                ]
            );
    }
}
