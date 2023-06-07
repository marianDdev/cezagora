<?php

namespace App\Services;

interface UserServiceInterface
{
    public function updateCompany(int $companyId): void;
}
