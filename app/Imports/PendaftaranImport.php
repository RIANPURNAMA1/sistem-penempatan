<?php

namespace App\Imports;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PendaftaranImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // --- 1. OLah Tanggal Daftar ---
        $tanggalDaftar = now()->format('Y-m-d');
        if (!empty($row['tanggal_daftar']) && is_numeric($row['tanggal_daftar'])) {
            try {
                $tanggalDaftar = Date::excelToDateTimeObject($row['tanggal_daftar'])->format('Y-m-d');
            } catch (\Throwable $e) {
                // Gunakan default jika konversi gagal
            }
        }

        // --- 2. OLah Tempat Tanggal Lahir (Penyebab Error 1292) ---
        $tempatTanggalLahir = null;
        if (!empty($row['tempat_tanggal_lahir']) && is_numeric($row['tempat_tanggal_lahir'])) {
            try {
                $tempatTanggalLahir = Date::excelToDateTimeObject($row['tempat_tanggal_lahir'])->format('Y-m-d');
            } catch (\Throwable $e) {
                // Biarkan sebagai null jika konversi gagal
            }
        }

        // --- 3. Tentukan User ID (Gunakan default 1 jika tidak login) ---
        $userId = Auth::id() ?? 1;

        return new Pendaftaran([

            // Identitas dasar: Ubah '' menjadi NULL untuk kolom opsional
            'nik'           => $row['nik'] ?? null,
            'nama'          => $row['nama'] ?? null,
            'usia'          => $row['usia'] ?? null, // Mengirim NULL jika kosong
            'agama'         => $row['agama'] ?? null, // Mengirim NULL jika kosong
            'status'        => $row['status'] ?? 'belum menikah',
            'email'         => $row['email'] ?? null,
            'no_wa'         => $row['no_wa'] ?? null,
            'jenis_kelamin' => $row['jenis_kelamin'] ?? 'Laki-laki',

            'tanggal_daftar'       => $tanggalDaftar,
            'tempat_tanggal_lahir' => $tempatTanggalLahir, // FIX: Mengirim NULL jika kosong
            'tempat_lahir'         => $row['tempat_lahir'] ?? null, // Mengirim NULL jika kosong
            'alamat'               => $row['alamat'] ?? null, // Mengirim NULL jika kosong

            // Lokasi lengkap: Ubah '' menjadi NULL
            'provinsi'      => $row['provinsi'] ?? null,
            'kab_kota'      => $row['kab_kota'] ?? null,
            'kecamatan'     => $row['kecamatan'] ?? null,
            'kelurahan'     => $row['kelurahan'] ?? null,

            // Tambahan (sudah benar menggunakan NULL)
            'id_prometric'       => $row['id_prometric'] ?? null,
            'password_prometric' => $row['password_prometric'] ?? null,
            'pernah_ke_jepang'   => $row['pernah_ke_jepang'] ?? 'Tidak',
            'paspor'             => $row['paspor'] ?? null,

            // Dokumen: Dibiarkan 'default.jpg' jika Anda ingin string itu tersimpan
            'foto'               => $row['foto'] ?? 'default.jpg',
            'sertifikat_jft'     => $row['sertifikat_jft'] ?? 'default.jpg',
            'sertifikat_ssw'     => $row['sertifikat_ssw'] ?? 'default.jpg',
            'kk'                 => $row['kk'] ?? 'default.jpg',
            'ktp'                => $row['ktp'] ?? 'default.jpg',
            'bukti_pelunasan'    => $row['bukti_pelunasan'] ?? 'default.jpg',
            'akte'               => $row['akte'] ?? 'default.jpg',
            'ijasah'             => $row['ijasah'] ?? 'default.jpg',

            // Status verifikasi
            'verifikasi'    => $row['verifikasi'] ?? 'menunggu',

            // Catatan admin
            'catatan_admin' => $row['catatan_admin'] ?? null,

            // Relasi user & cabang
            'user_id'   => $userId,
            'cabang_id' => $row['cabang_id'] ?? 1,
        ]);
    }
}