<?php

namespace App\Services\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public function setCompany(int $companyId): void
    {
        /** @var User $user */
        $user = Auth::user();
        $user->company_id = $companyId;
        $user->save();
    }

    public function softDelete(User $user): void
    {
        $user->deleted_at = Carbon::now();
        $user->is_active = false;
        $user->save();
    }
}
