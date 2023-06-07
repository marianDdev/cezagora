<?php

namespace App\Services;

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public function updateCompany(int $companyId): void
    {
        /** @var User $user */
        $user = Auth::user();
        $user->company_id = $companyId;
        $user->save();
    }
}
