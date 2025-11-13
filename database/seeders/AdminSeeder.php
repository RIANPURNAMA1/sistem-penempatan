<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar admin
        $admins = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => 'superadmin123',
                'role' => 'super admin',
            ],
            [
                'name' => 'Admin Cianjur',
                'email' => 'admincianjur@example.com',
                'password' => 'admincianjur123',
                'role' => 'admin cianjur',
            ],
            [
                'name' => 'Admin Cianjur Selatan',
                'email' => 'admincianjurselatan@example.com',
                'password' => 'admincianjurselatan123',
                'role' => 'admin cianjur selatan',
            ],
        ];

        foreach ($admins as $admin) {
            // Ambil role
            $role = Role::firstOrCreate(['name' => $admin['role']]);

            // Buat user admin
            User::firstOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                    'role_id' => $role->id,
                ]
            );
        }
    }
}
