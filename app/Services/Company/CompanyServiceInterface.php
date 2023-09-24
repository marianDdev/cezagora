<?php

namespace App\Services\Company;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Collection;

interface CompanyServiceInterface
{
    public function create(array $validated): Company;

    public function search(string $keyword): Collection;

    public function toggleActive(User $user, bool $activate): void;
}
