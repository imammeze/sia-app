<?php

namespace App\Policies;

use App\Models\Tema;
use App\Models\User;

class TemaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_tema');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tema $model): bool
    {
        return $user->can('view_tema');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_tema');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tema $model): bool
    {
        return $user->can('update_tema');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tema $model): bool
    {
        return $user->can('delete_tema');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tema $model): bool
    {
        return $user->can('restore_tema');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tema $model): bool
    {
        return $user->can('force_delete_tema');
    }
}