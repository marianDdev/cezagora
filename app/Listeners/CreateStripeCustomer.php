<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\Stripe\Customer\CustomerServiceInterface;

class CreateStripeCustomer
{
    private CustomerServiceInterface $customerService;

    /**
     * Create the event listener.
     */
    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        /** @var User $user */
        $user = $event->company->user;
        $customer = $this->customerService->createCustomer($user);
        $user->update(['stripe_customer_id' => $customer->id]);
    }
}
