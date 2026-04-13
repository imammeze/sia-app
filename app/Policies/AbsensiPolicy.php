<?php

namespace App\Policies;

use App\Models\Absensi;
use App\Models\User;

class AbsensiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_absensi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Absensi $model): bool
    {
        return $user->can('view_absensi');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_absensi');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Absensi $model): bool
    {
        return $user->can('update_absensi');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Absensi $model): bool
    {
        return $user->can('delete_absensi');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Absensi $model): bool
    {
        return $user->can('restore_absensi');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Absensi $model): bool
    {
        return $user->can('force_delete_absensi');
    }
}