<?php

namespace App\Services\Stripe\Account;

use Stripe\Account;

interface StripeAccountServiceInterface
{
    public function create(): Account;

    public function retrieve(string $id): Account;
}
