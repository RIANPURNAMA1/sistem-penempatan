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
        // ========================================
        // Helper: ambil nilai atau default
        // ========================================
        $get = fn($key, $default = null) => (isset($row[$key]) && $row[$key] !== '') ? $row[$key] : $default;

        // ========================================
        // 1. Tanggal Daftar (default hari ini)
        // ========================================
        $tanggalDaftar = now()->format('Y-m-d');

        if (!empty($row['tanggal_daftar']) && is_numeric($row['tanggal_daftar'])) {
            try {
                $tanggalDaftar = Date::excelToDateTimeObject($row['tanggal_daftar'])
                    ->format('Y-m-d');
            } catch (\Throwable $e) {
                // Abaikan error
            }
        }

        // ========================================
        // 2. Tempat / Tanggal Lahir
        // ========================================
        $tempatTanggalLahir = null;

        if (!empty($row['tempat_tanggal_lahir'])) {
            if (is_numeric($row['tempat_tanggal_lahir'])) {
                try {
                    $tempatTanggalLahir = Date::excelToDateTimeObject($row['tempat_tanggal_lahir'])
                        ->format('Y-m-d');
                } catch (\Throwable $e) {
                }
            } else {
                $tempatTanggalLahir = $row['tempat_tanggal_lahir'];
            }
        }

        // ========================================
        // 3. Auto Create User (email boleh kosong)
        // ========================================
        $email = !empty($row['email'])
            ? $row['email']
            : 'mendunia' . rand(100000, 999999) . '@gmail.com';

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name'     => $get('nama', 'Data Kosong'),
                'password' => Hash::make('mendunia123'),
                'role'     => 'kandidat',
            ]
        );

        $userId = $user->id;


        $userId = $user->id ?? Auth::id() ?? 1;

        // ========================================
        // 4. Ambil Cabang Berdasarkan Nama
        // ========================================
        $cabangId = 1;

        if (!empty($row['cabang'])) {
            $cabang = Cabang::where('nama_cabang', $row['cabang'])->first();
            if ($cabang) {
                $cabangId = $cabang->id;
            }
        } elseif (Auth::user()) {
            $cabangId = Auth::user()->cabang_id ?? 1;
        }

        // ========================================
        // 5. Simpan ke database (aman untuk excel kosong)
        // ========================================
        return new Pendaftaran([

            // Identitas dasar
            'nik'                => $get('nik', 'NIK-' . rand(100000, 999999)),
            'nama'               => $get('nama', 'Data Kosong'),
            'usia'               => $get('usia', 'Data Kosong'),
            'agama'              => $get('agama', 'Data Kosong'),
            'status'             => $get('status', 'belum menikah'),

            'email'              => $get('email', 'email' . rand(1000, 9999) . '@gmail.com'),
            'no_wa'              => $get('no_wa', '080000000000'),
            'jenis_kelamin'      => $get('jenis_kelamin', 'Laki-laki'),

            'tanggal_daftar'     => $tanggalDaftar,

            // Tempat & Tanggal Lahir
            'tempat_tanggal_lahir' => $tempatTanggalLahir,
            'tempat_lahir'         => $get('tempat_lahir', 'Data Kosong'),

            // Alamat & Pendidikan
            'alamat'              => $get('alamat', 'Data Kosong'),
            'pendidikan_terakhir' => $get('pendidikan_terakhir', 'Data Kosong'),
            'bidang_ssw'          => $get('bidang_ssw', 'Lainnya'),

            // Lokasi administratif
            'provinsi'            => $get('provinsi', 'Data Kosong'),
            'kab_kota'            => $get('kab_kota', 'Data Kosong'),
            'kecamatan'           => $get('kecamatan', 'Data Kosong'),
            'kelurahan'           => $get('kelurahan', 'Data Kosong'),

            // Tambahan
            'id_prometric'        => $get('id_prometric', '-'),
            'password_prometric'  => $get('password_prometric', '-'),
            'pernah_ke_jepang'    => $get('pernah_ke_jepang', 'Tidak'),
            'paspor'              => $get('paspor', null),

            // Dokumen file (default jika kosong)
            'foto'               => $get('foto', 'Data Kosong'),
            'sertifikat_jft'     => $get('sertifikat_jft', null),
            'sertifikat_ssw'     => $get('sertifikat_ssw', null),
            'kk'                 => $get('kk', null),
            'ktp'                => $get('ktp', null),
            'bukti_pelunasan'    => $get('bukti_pelunasan', null),
            'akte'               => $get('akte', null),
            'ijasah'             => $get('ijasah', null),

            // Admin
            'verifikasi'         => $get('verifikasi', 'menunggu'),
            'catatan_admin'      => $get('catatan_admin', null),

            // Relasi
            'user_id'            => $userId,
            'cabang_id'          => $cabangId,
        ]);
    }
}
