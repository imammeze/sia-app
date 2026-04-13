<?php

namespace App\Policies;

use App\Models\Guru;
use App\Models\User;

class GuruPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_guru');
    }

    public function view(User $user, Guru $model): bool
    {
        return $user->can('view_guru');
    }

    public function create(User $user): bool
    {
        return $user->can('create_guru');
    }

    public function update(User $user, Guru $model): bool
    {
        return $user->can('update_guru');
    }

    public function delete(User $user, Guru $model): bool
    {
        return $user->can('delete_guru');
    }

    public function restore(User $user, Guru $model): bool
    {
        return $user->can('restore_guru');
    }
    
    public function forceDelete(User $user, Guru $model): bool
    {
        return $user->can('force_delete_guru');
    }
}