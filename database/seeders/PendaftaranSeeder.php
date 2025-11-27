<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        $statuses = ['belum menikah', 'menikah', 'lajang'];
        $jk = ['Laki-laki', 'Perempuan'];
        $verifikasiStatus = ['menunggu', 'data belum lengkap', 'diterima', 'ditolak'];
        $jepang = ['Ya', 'Tidak'];

        for ($i = 1; $i <= 20; $i++) {

            DB::table('pendaftarans')->insert([

                // Relasi
                'user_id'   => rand(1, 20),      // pastikan ada user 1–20
                'cabang_id' => rand(1, 10),      // pastikan ada cabang 1–10

                'nik'   => $faker->unique()->numerify('3276###########'),
                'nama'  => $faker->name(),
                'usia'  => rand(18, 35),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),

                'status' => $faker->randomElement($statuses),

                'email'  => $faker->unique()->safeEmail(),
                'no_wa'  => "08" . rand(111111111, 999999999),

                'jenis_kelamin' => $faker->randomElement($jk),

                'tanggal_daftar' => Carbon::now()->subDays(rand(0, 365)),
                'tempat_tanggal_lahir' => Carbon::now()->subYears(rand(18, 30)),
                'tempat_lahir' => $faker->city(),

                'alamat' => $faker->address(),

                // Lokasi
                'provinsi'  => 'Jawa Barat',
                'kab_kota'  => 'Cianjur',
                'kecamatan' => 'Cugenang',
                'kelurahan' => 'Panembong',

                // Tambahan
                'id_prometric'        => Str::upper(Str::random(8)),
                'password_prometric'  => Str::random(10),
                'pernah_ke_jepang'    => $faker->randomElement($jepang),
                'paspor'              => rand(0, 1) ? 'paspor_' . $i . '.jpg' : null,

                // Upload dokumen (dummy path)
                'foto'             => "uploads/foto/foto_$i.jpg",
                'sertifikat_jft'   => "uploads/sertifikat/jft_$i.jpg",
                'sertifikat_ssw'   => "uploads/sertifikat/ssw_$i.jpg",
                'kk'               => "uploads/kk/kk_$i.jpg",
                'ktp'              => "uploads/ktp/ktp_$i.jpg",
                'bukti_pelunasan'  => "uploads/pelunasan/pelunasan_$i.jpg",
                'akte'             => "uploads/akte/akte_$i.jpg",
                'ijasah'           => "uploads/ijasah/ijasah_$i.jpg",

                'verifikasi'     => 'menunggu',
                'catatan_admin'  => $faker->boolean() ? $faker->sentence() : null,

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
