<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    use WithoutModelEvents;

     public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $entities = ['user', 'guru', 'kelas', 'pendaftaran', 'peserta_didik', 'absensi', 'perkembangan_anak', 'rapor', 'tema'];
        $actions = ['view_any', 'view', 'create', 'update', 'delete'];

        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "{$action}_{$entity}"]);
            }
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all()); 

        $kepsek = Role::firstOrCreate(['name' => 'kepala_sekolah']);
        $kepsek->givePermissionTo(Permission::where('name', 'like', 'view%')->get());

        $guru = Role::firstOrCreate(['name' => 'guru']);
        $guru->givePermissionTo([
            'view_any_peserta_didik', 'view_peserta_didik',
            'view_any_kelas', 'view_kelas',
            ...Permission::whereIn('name', [
                'view_any_absensi', 'view_absensi', 'create_absensi', 'update_absensi', 'delete_absensi',
                'view_any_perkembangan_anak', 'view_perkembangan_anak', 'create_perkembangan_anak', 'update_perkembangan_anak', 'delete_perkembangan_anak',
                'view_any_rapor', 'view_rapor', 'create_rapor', 'update_rapor', 'delete_rapor',
            ])->pluck('name')->toArray()
        ]);
    }
}