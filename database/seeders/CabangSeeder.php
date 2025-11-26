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
                'nama_cabang' => 'Cabang Cianjur Selatan Mendunia',
                'alamat' => 'Jl. Sudirman No. 10, Cianjur Selatan',
            ],
            [
                'nama_cabang' => 'Cabang Cianjur Pamoyanan Mendunia',
                'alamat' => 'Jl. Dago No. 25, Cianjur',
            ],
            [
                'nama_cabang' => 'Cabang Batam Mendunia',
                'alamat' => 'Jl. Raja Haji Fisabilillah No. 5, Batam',
            ],
            [
                'nama_cabang' => 'Cabang Banyuwangi Mendunia',
                'alamat' => 'Jl. Letjen Panjaitan No. 12, Banyuwangi',
            ],
            [
                'nama_cabang' => 'Cabang Kendal Mendunia',
                'alamat' => 'Jl. Pemuda No. 8, Kendal',
            ],
            [
                'nama_cabang' => 'Cabang Pati Mendunia',
                'alamat' => 'Jl. Diponegoro No. 15, Pati',
            ],
            [
                'nama_cabang' => 'Cabang Tulung Agung Mendunia',
                'alamat' => 'Jl. Basuki Rahmat No. 7, Tulung Agung',
            ],
            [
                'nama_cabang' => 'Cabang Bangkalan Mendunia',
                'alamat' => 'Jl. Trunojoyo No. 20, Bangkalan',
            ],
            [
                'nama_cabang' => 'Cabang Bojonegoro Mendunia',
                'alamat' => 'Jl. Sultan Agung No. 3, Bojonegoro',
            ],
            [
                'nama_cabang' => 'Cabang Jember Mendunia',
                'alamat' => 'Jl. Gajah Mada No. 10, Jember',
            ],
            [
                'nama_cabang' => 'Cabang Wonosobo Mendunia',
                'alamat' => 'Jl. Diponegoro No. 5, Wonosobo',
            ],
            [
                'nama_cabang' => 'Cabang Eshan Mendunia',
                'alamat' => 'Jl. Merdeka No. 1, Eshan',
            ],
        ];


        foreach ($cabangData as $cabang) {
            Cabang::create($cabang);
        }
    }
}
