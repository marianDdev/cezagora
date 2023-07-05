<?php

namespace App\Traits;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AuthUser
{
    public function authUser(): ?User
    {
        /** @var User $user */
        $user = Auth::user();

        return $user;
    }

    public function authUserCompany(): ?Company
    {
        $authUser = $this->authUser();

        return $authUser?->company;
    }
}
