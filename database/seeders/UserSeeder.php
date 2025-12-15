<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cabang;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadminmendunia@gmail.com',
            'password' => Hash::make('superadmin1234567890'),
            'role' => 'super-admin',
        ]);

        // Daftar cabang
        $cabangRoles = [
            'Cabang Cianjur Selatan Mendunia',
            'Cabang Cianjur Pamoyanan Mendunia',
            'Cabang Batam Mendunia',
            'Cabang Banyuwangi Mendunia',
            'Cabang Kendal Mendunia',
            'Cabang Pati Mendunia',
            'Cabang Tulung Agung Mendunia',
            'Cabang Bangkalan Mendunia',
            'Cabang Bojonegoro Mendunia',
            'Cabang Jember Mendunia',
            'Cabang Wonosobo Mendunia',
            'Cabang Eshan Mendunia',
        ];

        foreach ($cabangRoles as $roleName) {
            // Ambil ID cabang dari tabel cabangs
            $cabang = Cabang::where('nama_cabang', $roleName)->first();

            if ($cabang) {
                User::create([
                    'name' => "Admin " . $cabang->nama_cabang,
                    'email' => strtolower(str_replace(' ', '', $cabang->nama_cabang)) . '@gmail.com',
                    'password' => Hash::make('admin123'),
                    'role' => $cabang->nama_cabang,
                    'cabang_id' => $cabang->id,
                ]);
            }
        }
    }
}
