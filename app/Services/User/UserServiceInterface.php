<?php

namespace App\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    public const ROLE_SELLER = 'seller';
    public const ROLE_BUYER = 'buyer';
    public const ROLE_ADMIN = 'admin';
    public const ROLES = [self::ROLE_SELLER, self::ROLE_BUYER, self::ROLE_ADMIN];

    public function setCompany(int $companyId): void;

    public function toggleActive(User $user, bool $activate, string $deletedAt = null): void;
}
