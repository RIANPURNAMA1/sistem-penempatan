<?php
namespace App\Imports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PendaftaranImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Convert tanggal dari Excel jika ada
        if (!empty($row['tanggal_daftar'])) {
            try {
                $tanggalDaftar = Date::excelToDateTimeObject($row['tanggal_daftar'])->format('Y-m-d');
            } catch (\Exception $e) {
                // Jika gagal convert, gunakan tanggal sekarang
                $tanggalDaftar = now()->format('Y-m-d');
            }
        } else {
            $tanggalDaftar = now()->format('Y-m-d');
        }

        return new Pendaftaran([
            'nik'            => $row['nik'] ?? '0000000000000000',
            'nama'           => $row['nama'] ?? 'Nama Tidak Diketahui',
            'email'          => $row['email'] ?? 'email@default.com',
            'alamat'         => $row['alamat'] ?? 'Alamat Tidak Diketahui',
            'jenis_kelamin'  => in_array($row['jenis_kelamin'] ?? null, ['Laki-laki','Perempuan']) ? $row['jenis_kelamin'] : 'Laki-laki',
            'no_wa'          => $row['no_wa'] ?? '0000000000',
            'provinsi'       => $row['provinsi'] ?? 'Unknown',
            'kab_kota'       => $row['kab_kota'] ?? 'Unknown',
            'kecamatan'      => $row['kecamatan'] ?? 'Unknown',
            'kelurahan'      => $row['kelurahan'] ?? 'Unknown',
            'foto'           => $row['foto'] ?? 'default.jpg',
            'kk'             => $row['kk'] ?? 'default.jpg',
            'ktp'            => $row['ktp'] ?? 'default.jpg',
            'bukti_pelunasan'=> $row['bukti_pelunasan'] ?? 'default.jpg',
            'akte'           => $row['akte'] ?? 'default.jpg',
            'ijasah'         => $row['ijasah'] ?? 'default.jpg',
            'cabang_id'      => $row['cabang_id'] ?? 1,
            'tanggal_daftar' => $tanggalDaftar,
            'verifikasi'     => in_array($row['verifikasi'] ?? null, ['menunggu','data belum lengkap','diterima','ditolak']) ? $row['verifikasi'] : 'menunggu',
            'catatan_admin'  => $row['catatan_admin'] ?? null,
            'user_id'        => Auth::id(),
        ]);
    }
}

