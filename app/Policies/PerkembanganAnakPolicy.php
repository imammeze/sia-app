<?php

namespace App\Policies;

use App\Models\PerkembanganAnak;
use App\Models\User;

class PerkembanganAnakPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_perkembangan_anak');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PerkembanganAnak $model): bool
    {
        return $user->can('view_perkembangan_anak');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_perkembangan_anak');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PerkembanganAnak $model): bool
    {
        return $user->can('update_perkembangan_anak');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PerkembanganAnak $model): bool
    {
        return $user->can('delete_perkembangan_anak');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PerkembanganAnak $model): bool
    {
        return $user->can('restore_perkembangan_anak');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PerkembanganAnak $model): bool
    {
        return $user->can('force_delete_perkembangan_anak');
    }
}