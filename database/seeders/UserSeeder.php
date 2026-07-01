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
            ['email' => 'admin@tunasbangsa.sch.id'],
            ['name' => 'Admin', 'password' => bcrypt('admin123')]
        );
        $admin->assignRole('admin');

        $admin2 = User::firstOrCreate(
            ['email' => 'sulistyani@tunasbangsa.sch.id'],
            ['name' => 'Sulistyani', 'password' => bcrypt('sulistyani123')]
        );
        $admin2->assignRole( 'guru');

        $kepsek = User::firstOrCreate(
            ['email' => 'cuciharyati@tunasbangsa.sch.id'],
            ['name' => 'Cuci Haryati', 'password' => bcrypt('cuciharyati123')]
        );
        $kepsek->assignRole(['kepala_sekolah']);

        $guru = User::firstOrCreate(
            ['email' => 'akhyani@tunasbangsa.sch.id'],
            ['name' => 'Akhyani', 'password' => bcrypt('akhyani123')]
        );
        $guru->assignRole('guru');
        
        $guru1 = User::firstOrCreate(
            ['email' => 'ika@tunasbangsa.sch.id'],
            ['name' => 'Ika Rusdwuhartanti', 'password' => bcrypt('ika12345')]
        );
        $guru1->assignRole('guru');
    }
}