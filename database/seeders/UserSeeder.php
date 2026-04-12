<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    
     public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@tunasbangsa.com'],
            ['name' => 'Admin', 'password' => bcrypt('admin123')]
        );
        $admin->assignRole('admin');

        $admin2 = User::firstOrCreate(
            ['email' => 'sulistyani@tunasbangsa.com'],
            ['name' => 'Sulistyani', 'password' => bcrypt('sulistyani123')]
        );
        $admin2->assignRole(['admin', 'guru']);

        $kepsek = User::firstOrCreate(
            ['email' => 'cuciharyati@tunasbangsa.com'],
            ['name' => 'Cuci Haryati', 'password' => bcrypt('cuciharyati123')]
        );
        $kepsek->assignRole(['kepala_sekolah', 'guru']);

        $guru = User::firstOrCreate(
            ['email' => 'akhyani@tunasbangsa.com'],
            ['name' => 'Akhyani', 'password' => bcrypt('akhyani123')]
        );
        $guru->assignRole('guru');
        
        $guru1 = User::firstOrCreate(
            ['email' => 'ika@tunasbangsa.com'],
            ['name' => 'Ika Rusdwuhartanti', 'password' => bcrypt('ika12345')]
        );
        $guru1->assignRole('guru');
    }
}