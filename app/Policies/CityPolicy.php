<?php

namespace App\Policies;

use App\Models\City;
use App\Models\User;

class CityPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('cities.index');
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasPermissionTo('cities.show');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('cities.create');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo('cities.edit');
    }

    public function store(User $user): bool
    {
        return $user->hasPermissionTo('cities.store');
    }


    public function delete(User $user, User $model): bool
    {
        return $user->hasPermissionTo('cities.delete');
    }
}
