<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'cities.index',
            'cities.create',
            'cities.store',
            'cities.show',
            'cities.edit',
            'cities.update',
            'cities.destroy',
            'chats.index',
            'chats.create',
            'chats.store',
            'chats.show',
            'chats.destroy',
            'messages.store',
            'tickets.index',
            'tickets.store',
            'tickets.show',
            'tickets.destroy',
            'users.index',
            'users.show',
            'users.edit',
            'users.update',
            'users.store',
            'users.create',
            'users.destroy',
            'vehicles.index',
            'vehicles.show',
            'vehicles.edit',
            'vehicles.update',
            'vehicles.store',
            'vehicles.create',
            'vehicles.destroy',
            'vehicles.export',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'display_name' => ucfirst(str_replace('.', ' ', $permission)),
            ]);
        }

        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $userRole = Role::where('name', 'user')->first();

        $adminRole->permissions()->attach(Permission::all()->pluck('id'));
        $managerRole->permissions()->attach(Permission::all()->pluck('id'));
        $userRole->permissions()->attach(Permission::all()->pluck('id'));

    }
}
