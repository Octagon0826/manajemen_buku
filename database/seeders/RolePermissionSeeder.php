<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // Daftar permission
        $permissions = [
            'books.view',
            'books.create',
            'books.edit',
            'books.delete',
            'users.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Membuat role
        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $dosen = Role::firstOrCreate([
            'name' => 'dosen',
            'guard_name' => 'web',
        ]);

        $mahasiswa = Role::firstOrCreate([
            'name' => 'mahasiswa',
            'guard_name' => 'web',
        ]);

        // Hak akses Admin
        $admin->syncPermissions($permissions);

        // Hak akses Dosen
        $dosen->syncPermissions([
            'books.view',
            'books.create',
            'books.edit',
        ]);

        // Hak akses Mahasiswa
        $mahasiswa->syncPermissions([
            'books.view',
        ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();
    }
}