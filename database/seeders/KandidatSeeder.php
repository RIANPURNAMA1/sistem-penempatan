<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kandidat;
use App\Models\Pendaftaran;
use App\Models\Cabang;
use App\Models\Institusi;
use Illuminate\Support\Str;

class KandidatSeeder extends Seeder
{
    public function run(): void
    {
        $statusList = [
            'Job Matching',
            'Pending',
            'Interview',
            'Gagal Interview',
            'Jadwalkan Interview Ulang',
            'Lulus interview',
            'Pemberkasan',
            'Berangkat',
            'Ditolak',
        ];

        $pendaftaranIds = Pendaftaran::pluck('id')->toArray();
        $cabangIds = Cabang::pluck('id')->toArray();
        $institusiIds = Institusi::pluck('id')->toArray();

        if (empty($pendaftaranIds) || empty($cabangIds)) {
            dd("Seeder gagal: Pastikan tabel pendaftaran dan cabang terisi!");
        }

        for ($i = 1; $i <= 100; $i++) {
            Kandidat::create([
                'pendaftaran_id' => $pendaftaranIds[array_rand($pendaftaranIds)],
                'cabang_id'      => $cabangIds[array_rand($cabangIds)],
                'status_kandidat' => $statusList[array_rand($statusList)],
                'institusi_id'   => rand(0, 1) ? ($institusiIds[array_rand($institusiIds)] ?? null) : null,
                'jumlah_interview' => rand(0, 5),
                'catatan_interview' => rand(0, 1) ? Str::random(20) : null,
                'jadwal_interview' => rand(0, 1) ? now()->addDays(rand(1, 30))->format('Y-m-d') : null,
            ]);
        }
    }
}
