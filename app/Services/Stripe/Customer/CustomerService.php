<?php

namespace App\Services\Stripe\Customer;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use App\Services\Stripe\StripeService;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class CustomerService extends StripeService implements CustomerServiceInterface
{
    /**
     * @throws ApiErrorException
     */
    public function createCustomer(User $user): Customer
    {
        return $this->stripeClient->customers->create(
            [
                'email' => $user->email
            ],
            [
                'stripe_account' => $user->stripe_account_id
            ]
        );
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
