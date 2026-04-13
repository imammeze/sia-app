<?php

namespace App\Policies;

use App\Models\Kelas;
use App\Models\User;

class KelasPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_kelas');
    }

    public function view(User $user, Kelas $model): bool
    {
        return $user->can('view_kelas');
    }
    
    public function create(User $user): bool
    {
        return $user->can('create_kelas');
    }

    public function update(User $user, Kelas $model): bool
    {
        return $user->can('update_kelas');
    }

    public function delete(User $user, Kelas $model): bool
    {
        return $user->can('delete_kelas');
    }

    public function restore(User $user, Kelas $model): bool
    {
        return $user->can('restore_kelas');
    }   
    
    public function forceDelete(User $user, Kelas $model): bool
    {
        return $user->can('force_delete_kelas');
    }
}