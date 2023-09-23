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

    public function toggleActive(User $user, bool $activate, string $deletedAt = null): void
    {
        $user->deleted_at = $deletedAt;
        $user->is_active = $activate;
        $user->save();
    }
}
