<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabang;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        $cabangData = [
            [
                'nama_cabang' => 'Cabang Cainjur Selatan',
                'alamat' => 'Jl. Sudirman No. 10, Jakarta',
            ],
            [
                'nama_cabang' => 'Cabang Cianjur Pamoyanan',
                'alamat' => 'Jl. Dago No. 25,Cianjur',
            ],
            [
                'nama_cabang' => 'Cabang Surabaya',
                'alamat' => 'Jl. Pemuda No. 50, Surabaya',
            ],
            [
                'nama_cabang' => 'Cabang Yogyakarta',
                'alamat' => 'Jl. Malioboro No. 100, Yogyakarta',
            ],
            [
                'nama_cabang' => 'Cabang Medan',
                'alamat' => 'Jl. Thamrin No. 20, Medan',
            ],
        ];

        foreach ($cabangData as $cabang) {
            Cabang::create($cabang);
        }
    }
}
