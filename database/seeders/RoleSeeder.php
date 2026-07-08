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

        $entities = ['user', 'guru', 'kelas', 'pendaftaran', 'peserta_didik', 'absensi', 'perkembangan_anak', 'rapor', 'tema', 'kategori_capaian', 'capaian_pembelajaran'];
        $actions = ['view_any', 'view', 'create', 'update', 'delete', 'restore', 'force_delete'];

        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "{$action}_{$entity}"]);
            }
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([
            // Data Master
            'view_any_guru', 'view_guru', 'create_guru', 'update_guru', 'delete_guru', 'restore_guru', 'force_delete_guru',
            'view_any_kelas', 'view_kelas', 'create_kelas', 'update_kelas', 'delete_kelas', 'restore_kelas', 'force_delete_kelas',
            'view_any_peserta_didik', 'view_peserta_didik', 'create_peserta_didik', 'update_peserta_didik', 'delete_peserta_didik', 'restore_peserta_didik', 'force_delete_peserta_didik',
            'view_any_tema', 'view_tema', 'create_tema', 'update_tema', 'delete_tema', 'restore_tema', 'force_delete_tema',
            // Pendaftaran
            'view_any_pendaftaran', 'view_pendaftaran', 'create_pendaftaran', 'update_pendaftaran', 'delete_pendaftaran', 'restore_pendaftaran', 'force_delete_pendaftaran',
            // User Management
            'view_any_user', 'view_user', 'create_user', 'update_user', 'delete_user', 'restore_user', 'force_delete_user',
        ]);

        $guru = Role::firstOrCreate(['name' => 'guru']);
        $guru->syncPermissions([
            // Akademik
            'view_any_absensi', 'view_absensi', 'create_absensi', 'update_absensi', 'delete_absensi', 'restore_absensi', 'force_delete_absensi',
            'view_any_kategori_capaian', 'view_kategori_capaian', 'create_kategori_capaian', 'update_kategori_capaian', 'delete_kategori_capaian', 'restore_kategori_capaian', 'force_delete_kategori_capaian',
            'view_any_perkembangan_anak', 'view_perkembangan_anak', 'create_perkembangan_anak', 'update_perkembangan_anak', 'delete_perkembangan_anak', 'restore_perkembangan_anak', 'force_delete_perkembangan_anak',
        ]);

        $kepsek = Role::firstOrCreate(['name' => 'kepala_sekolah']);
        $kepsek->syncPermissions(Permission::where('name', 'like', 'view%')->get());
    }
}