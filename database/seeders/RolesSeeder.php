<?php

namespace Database\Seeders;

use App\Services\User\UserServiceInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (UserServiceInterface::ROLES as $role) {
            Role::create(['name' => $role]);
        }
    }
}
