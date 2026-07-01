<?php

namespace App\Policies;

use App\Models\KategoriCapaian;
use App\Models\User;

class KategoriCapaianPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_kategori_capaian');
    }

    public function view(User $user, KategoriCapaian $model): bool
    {
        return $user->can('view_kategori_capaian');
    }

    public function create(User $user): bool
    {
        return $user->can('create_kategori_capaian');
    }

    public function update(User $user, KategoriCapaian $model): bool
    {
        return $user->can('update_kategori_capaian');
    }

    public function delete(User $user, KategoriCapaian $model): bool
    {
        return $user->can('delete_kategori_capaian');
    }

    public function restore(User $user, KategoriCapaian $model): bool
    {
        return $user->can('restore_kategori_capaian');
    }

    public function forceDelete(User $user, KategoriCapaian $model): bool
    {
        return $user->can('force_delete_kategori_capaian');
    }
}
