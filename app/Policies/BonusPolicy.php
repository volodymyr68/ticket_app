<?php

namespace App\Policies;

use App\Models\Bonus;
use App\Models\User;

class BonusPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('vehicles.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bonus $bonus): bool
    {
        return $user->hasPermissionTo('vehicles.show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('vehicles.store');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bonus $bonus): bool
    {
        return $user->hasPermissionTo('vehicles.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bonus $bonus): bool
    {
        return $user->hasPermissionTo('vehicles.destroy');
    }

}
