<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('superadmin123'), // password default
            'role' => 'super admin',
        ]);

        // Admin Cianjur Selatan
        User::create([
            'name' => 'Admin Cianjur Selatan',
            'email' => 'admincianjurselatan@example.com',
            'password' => Hash::make('admincianjur123'),
            'role' => 'admin cianjur selatan',
        ]);

        // Admin Cianjur
        User::create([
            'name' => 'Admin Cianjur',
            'email' => 'admincianjur@example.com',
            'password' => Hash::make('admincianjur123'),
            'role' => 'admin cianjur',
        ]);
    }
}
