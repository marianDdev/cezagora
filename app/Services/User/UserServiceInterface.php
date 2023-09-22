<?php

namespace App\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    public function setCompany(int $companyId): void;

    public function softDelete(User $user): void;
}
