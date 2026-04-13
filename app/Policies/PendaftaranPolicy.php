<?php

namespace App\Policies;

use App\Models\Pendaftaran;
use App\Models\User;

class PendaftaranPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_pendaftaran');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pendaftaran $model): bool
    {
        return $user->can('view_pendaftaran');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_pendaftaran');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pendaftaran $model): bool
    {
        return $user->can('update_pendaftaran');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pendaftaran $model): bool
    {
        return $user->can('delete_pendaftaran');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pendaftaran $model): bool
    {
        return $user->can('restore_pendaftaran');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pendaftaran $model): bool
    {
        return $user->can('force_delete_pendaftaran');
    }
}