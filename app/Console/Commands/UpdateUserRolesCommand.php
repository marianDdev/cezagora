<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class UpdateUserRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:user-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $usersWithoutRole = User::doesntHave('roles')->get();
        foreach ($usersWithoutRole as $user) {
            if ($user->isAdmin()) {
                $roleAdmin = Role::firstOrCreate(['name' => UserServiceInterface::ROLE_ADMIN]);
                $user->assignRole($roleAdmin);
                $this->info("Assigned role admin to {$user->email}");
            } elseif (is_null($user->company)) {
                $roleBuyer = Role::firstOrCreate(['name' => UserServiceInterface::ROLE_BUYER]);
                $user->assignRole($roleBuyer);
                $this->info("Assigned role buyer to {$user->email}");
            } elseif ($user->company->ingredients()->exists() ||
                      $user->company->packagings()->exists() ||
                      $user->company->services()->exists()) {
                $roleSeller = Role::firstOrCreate(['name' => UserServiceInterface::ROLE_SELLER]);
                $user->assignRole($roleSeller);
                $this->info("Assigned role seller to {$user->email}");
            } else {
                $roleBuyer = Role::firstOrCreate(['name' => UserServiceInterface::ROLE_BUYER]);
                $user->assignRole($roleBuyer);
                $this->info("Assigned role buyer to {$user->email}");
            }
        }
    }
}
