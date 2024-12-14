<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultRoles = ['user', 'admin', 'manager'];
        foreach ($defaultRoles as $role) {
            $roles[] = [
                'name' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Role::insert($roles);
    }
}
