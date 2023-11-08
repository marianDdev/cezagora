<?php

namespace App\Services\Stripe\Account;

use App\Models\Company;
use Illuminate\Support\Collection;
use Stripe\Account;

interface StripeAccountServiceInterface
{
    public function create(Company $company): Account;

    public function retrieve(string $id): Account;

    public function getShortMccList(): Collection;
}
