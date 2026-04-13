<?php

namespace App\Policies;

use App\Models\Rapor;
use App\Models\User;

class RaporPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_rapor');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Rapor $model): bool
    {
        return $user->can('view_rapor');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_rapor');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Rapor $model): bool
    {
        return $user->can('update_rapor');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Rapor $model): bool
    {
        return $user->can('delete_rapor');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Rapor $model): bool
    {
        return $user->can('restore_rapor');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Rapor $model): bool
    {
        return $user->can('force_delete_rapor');
    }
}