<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua user_id dan cabang_id yang tersedia
        $userIds = DB::table('users')->pluck('id')->toArray();
        $cabangIds = DB::table('cabangs')->pluck('id')->toArray(); // Pastikan tabel cabangs ada

        if (empty($userIds) || empty($cabangIds)) {
            $this->command->info('Tidak ada user atau cabang, seed dibatalkan.');
            return;
        }

        foreach (range(1, 10) as $i) { // Seed 10 data
            DB::table('pendaftarans')->insert([
                'user_id' => $faker->randomElement($userIds),
                'cabang_id' => $faker->randomElement($cabangIds),
                'nik' => $faker->unique()->numerify('###############'), // 15 digit NIK
                'nama' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'no_wa' => '08'.$faker->numerify('##########'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tanggal_daftar' => $faker->date(),
                'alamat' => $faker->address(),
                'provinsi' => $faker->state(),
                'kab_kota' => $faker->city(),
                'kecamatan' => $faker->word(),
                'kelurahan' => $faker->word(),
                'foto' => 'default.jpg',
                'kk' => 'kk.jpg',
                'ktp' => 'ktp.jpg',
                'bukti_pelunasan' => 'bukti.jpg',
                'akte' => 'akte.jpg',
                'ijasah' => 'ijasah.jpg',
                'verifikasi' => $faker->randomElement(['menunggu', 'data belum lengkap', 'diterima', 'ditolak']),
                'catatan_admin' => $faker->optional()->sentence(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
