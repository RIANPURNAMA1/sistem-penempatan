<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cv extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // HALAMAN 1 - Data Awal
        'user_id',
        'email',
        'cabang_id',
        'batch',
        'no_telepon',
        'no_orang_tua',
        'bidang_sertifikasi',
        'bidang_sertifikasi_lainnya',
        'program_pertanian_kawakami',
        'sertifikat_files',

        // HALAMAN 2 - Pengisian Data Diri
        'pas_foto',
        'pas_foto_cv',
        'nama_lengkap_romaji',
        'nama_lengkap_katakana',
        'nama_panggilan_romaji',
        'nama_panggilan_katakana',
        'jenis_kelamin',
        'agama',
        'agama_lainnya',
        'tanggal_lahir',
        'tempat_lahir',
        'usia',
        'alamat_lengkap',

        // Wilayah Domisili
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',

        'email_aktif',
        'status_perkawinan',
        'status_perkawinan_lainnya',
        'golongan_darah',
        'surat_izin_mengemudi',
        'jenis_sim',
        'merokok',
        'minum_alkohol',
        'bertato',
        'tinggi_badan',
        'berat_badan',
        'ukuran_pinggang',
        'ukuran_sepatu',
        'ukuran_atasan_baju',
        'ukuran_atasan_baju_lainnya',
        'ukuran_celana',
        'tangan_dominan',
        'kemampuan_penglihatan_mata',
        'kemampuan_pendengaran',
        'kemampuan_penglihatan_mata_lainnya',
        'sudah_vaksin_berapa_kali',
        'sudah_vaksin_berapa_kali_lainnya',
        'kesehatan_badan',
        'penyakit_cedera_masa_lalu',
        'hobi',
        'rencana_sumber_biaya_keberangkatan',
        'perkiraan_biaya',
        'Biaya_keberangkatan_sebelumnya_jisshu',

        // HALAMAN 3 - Pembelajaran di Mendunia
        'lama_belajar_di_mendunia',
        'kemampuan_bahasa_jepang',
        'kemampuan_pemahaman_ssw',
        'kelincahan_dalam_bekerja',
        'kekuatan_tindakan',
        'kemampuan_berbahasa_inggris',
        'kemampuan_berbahasa_inggris_lainnya',
        'kebugaran_jasmani_seminggu',
        'kebugaran_jasmani_seminggu_lainnya',

        // Pertanyaan Kerja
        'bersedia_kerja_shift',
        'bersedia_lembur',
        'bersedia_hari_libur',
        'menggunakan_kacamata',

        // HALAMAN 5 - Daya Tarik Perusahaan
        'ada_keluarga_di_jepang',
        'hubungan_keluarga_di_jepang',
        'status_kerabat_di_jepang',
        'status_kerabat_di_jepang_lainnya',
        'ingin_bekerja_berapa_tahun',
        'ingin_bekerja_berapa_tahun_lainnya',
        'ingin_pulang_berapa_kali',
        'kelebihan_diri',
        'komentar_guru_kelebihan_diri',
        'kekurangan_diri',
        'komentar_guru_kekurangan_diri',
        'ketertarikan_terhadap_jepang',
        'orang_yang_dihormati',
        'point_plus_diri',
        'keahlian_khusus',

        // HALAMAN 6 - Data Anggota Keluarga
        // ISTRI
        'istri_nama',
        'istri_usia',
        'istri_pekerjaan',
        'kontak_pasangan',

        // ANAK
        'anak_nama',
        'anak_jenis_kelamin',
        'anak_usia',
        'anak_pendidikan',

        // IBU
        'ibu_nama',
        'ibu_usia',
        'ibu_pekerjaan',

        // AYAH
        'ayah_nama',
        'ayah_usia',
        'ayah_pekerjaan',

        'kontak_orangtua',

        // KAKAK
        'kakak_nama',
        'kakak_usia',
        'kakak_jenis_kelamin',
        'kakak_pekerjaan',
        'kakak_status',

        // ADIK
        'adik_nama',
        'adik_usia',
        'adik_jenis_kelamin',
        'adik_pekerjaan',
        'adik_status',

        // PENGHASILAN KELUARGA
        'rata_rata_penghasilan_keluarga',
    ];

    // Tambahkan juga casting untuk JSON
    protected $casts = [
        'sertifikat_files' => 'array',
        'pas_foto' => 'array',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke cabang
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    public function Pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    // Relasi ke pendidikan (satu CV bisa punya banyak pendidikan)
    public function pendidikans()
    {
        return $this->hasMany(Pendidikan::class);
    }

    // Relasi ke pengalaman kerja (satu CV bisa punya banyak pengalaman)
    public function pengalamans()
    {
        return $this->hasMany(Pengalaman::class);
    }
    public function magangjisshu()
    {
        return $this->hasMany(MagangJisshu::class);
    }
    public function riwayatpekerjaanterakhir()
    {
        return $this->hasMany(riwayatpekerjaanterakhir::class);
    }
}
