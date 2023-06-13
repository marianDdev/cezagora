<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function updateCompany(int $companyId): void;
}
