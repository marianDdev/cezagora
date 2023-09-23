<?php

namespace App\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    public function setCompany(int $companyId): void;

    public function toggleActive(User $user, bool $activate, string $deletedAt = null): void;
}
