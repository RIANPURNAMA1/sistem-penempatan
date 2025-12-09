<?php

namespace App\Imports;

use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Cabang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PendaftaranImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // --- 1. Olah Tanggal Daftar ---
        $tanggalDaftar = now()->format('Y-m-d');
        if (!empty($row['tanggal_daftar']) && is_numeric($row['tanggal_daftar'])) {
            try {
                $tanggalDaftar = Date::excelToDateTimeObject($row['tanggal_daftar'])->format('Y-m-d');
            } catch (\Throwable $e) {}
        }

        // --- 2. Olah Tempat Tanggal Lahir ---
        $tempatTanggalLahir = null;
        if (!empty($row['tempat_tanggal_lahir']) && is_numeric($row['tempat_tanggal_lahir'])) {
            try {
                $tempatTanggalLahir = Date::excelToDateTimeObject($row['tempat_tanggal_lahir'])->format('Y-m-d');
            } catch (\Throwable $e) {}
        }

        // --- 3. Buat akun user otomatis jika belum ada ---
        $user = null;
        if (!empty($row['email'])) {
            $user = User::firstOrCreate(
                ['email' => $row['email']],
                [
                    'name' => $row['nama'] ?? 'No Name',
                    'password' => Hash::make('default123'), // password default
                    'role' => 'kandidat',
                ]
            );
        }

        // --- 4. Tentukan user_id untuk pendaftaran ---
        $userId = $user->id ?? Auth::id() ?? 1;

        // --- 5. Cari cabang dari nama cabang di Excel ---
        $cabangId = 1; // default
        if (!empty($row['cabang'])) {
            $cabang = Cabang::where('nama_cabang', $row['cabang'])->first();
            if ($cabang) {
                $cabangId = $cabang->id;
            }
        } else if (Auth::user()) {
            $cabangId = Auth::user()->cabang_id ?? 1;
        }

        // --- 6. Simpan data pendaftaran ---
        return new Pendaftaran([
            'nik'           => $row['nik'] ?? null,
            'nama'          => $row['nama'] ?? null,
            'usia'          => $row['usia'] ?? null,
            'agama'         => $row['agama'] ?? null,
            'status'        => $row['status'] ?? 'belum menikah',
            'email'         => $row['email'] ?? null,
            'no_wa'         => $row['no_wa'] ?? null,
            'jenis_kelamin' => $row['jenis_kelamin'] ?? 'Laki-laki',
            'tanggal_daftar'       => $tanggalDaftar,
            'tempat_tanggal_lahir' => $tempatTanggalLahir,
            'tempat_lahir'         => $row['tempat_lahir'] ?? null,
            'alamat'               => $row['alamat'] ?? null,
            'provinsi'      => $row['provinsi'] ?? null,
            'kab_kota'      => $row['kab_kota'] ?? null,
            'kecamatan'     => $row['kecamatan'] ?? null,
            'kelurahan'     => $row['kelurahan'] ?? null,
            'id_prometric'       => $row['id_prometric'] ?? null,
            'password_prometric' => $row['password_prometric'] ?? null,
            'pernah_ke_jepang'   => $row['pernah_ke_jepang'] ?? 'Tidak',
            'paspor'             => $row['paspor'] ?? null,
            'foto'               => $row['foto'] ?? 'default.jpg',
            'sertifikat_jft'     => $row['sertifikat_jft'] ?? 'default.jpg',
            'sertifikat_ssw'     => $row['sertifikat_ssw'] ?? 'default.jpg',
            'kk'                 => $row['kk'] ?? 'default.jpg',
            'ktp'                => $row['ktp'] ?? 'default.jpg',
            'bukti_pelunasan'    => $row['bukti_pelunasan'] ?? 'default.jpg',
            'akte'               => $row['akte'] ?? 'default.jpg',
            'ijasah'             => $row['ijasah'] ?? 'default.jpg',
            'verifikasi'         => $row['verifikasi'] ?? 'menunggu',
            'catatan_admin'      => $row['catatan_admin'] ?? null,
            'user_id'            => $userId,
            'cabang_id'          => $cabangId,
        ]);
    }
}
