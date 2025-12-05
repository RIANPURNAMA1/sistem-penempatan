<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPekerjaanTerakhir extends Model
{
    protected $table = 'riwayat_pekerjaan_terakhir';

    protected $fillable = [
        'cv_id',
        'nama_perusahaan',
        'nama_kumiai',
        'total_karyawan',
        'total_karyawan_asing',
        'bidang_pekerjaan',
        'klasifikasi_pekerjaan',

        // Masa Pelatihan
        'masa_pelatihan_mulai_tahun',
        'masa_pelatihan_mulai_bulan',
        'masa_pelatihan_selesai_tahun',
        'masa_pelatihan_selesai_bulan',

        'penanggung_jawab',
        'shift_normal',

        // Jam kerja
        'jam_kerja_mulai_1',
        'jam_kerja_selesai_1',
        'jam_kerja_mulai_2',
        'jam_kerja_selesai_2',
        'jam_kerja_mulai_3',
        'jam_kerja_selesai_3',

        'hari_libur',
        'detail_pekerjaan',
        'barang_cacat_action',

        // Tempat Tinggal
        'prefektur',
        'kota',

        // Status visa
        'status_visa',

        // Masa tinggal sebelumnya
        'masa_tinggal_mulai_tahun',
        'masa_tinggal_mulai_bulan',
        'masa_tinggal_selesai_tahun',
        'masa_tinggal_selesai_bulan',

        // Gaji
        'gaji_per_jam',
        'gaji_bersih',

        // Lembur rata-rata
        'lembur_bulanan',

        // Asrama
        'asrama_kamar',
        'asrama_jumlah_orang',

        // Transportasi
        'transportasi',
        'jarak_tempuh_menit',

        // Hanko
        'punya_hanko',
        'nama_hanko_sama_cv',
        'nama_katakana_hanko',
    ];

    /**
     * Relasi ke CV
     */
    public function cv()
    {
        return $this->belongsTo(Cv::class, 'cv_id');
    }
}
