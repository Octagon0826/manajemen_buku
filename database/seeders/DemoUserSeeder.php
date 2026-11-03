<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@manajemenbuku.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin12345'),
            ]
        );

        $admin->syncRoles(['admin']);

        // Akun Dosen
        $dosen = User::updateOrCreate(
            ['email' => 'dosen@manajemenbuku.test'],
            [
                'name' => 'Dosen Pengajar',
                'password' => Hash::make('dosen12345'),
            ]
        );

        $dosen->syncRoles(['dosen']);

        // Akun Mahasiswa
        $mahasiswa = User::updateOrCreate(
            ['email' => 'mahasiswa@manajemenbuku.test'],
            [
                'name' => 'Mahasiswa',
                'password' => Hash::make('mahasiswa12345'),
            ]
        );

        $mahasiswa->syncRoles(['mahasiswa']);
    }
}