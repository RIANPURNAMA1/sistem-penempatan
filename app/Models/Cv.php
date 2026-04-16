<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cv extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
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
        'lama_belajar_di_mendunia',
        'kemampuan_bahasa_jepang',
        'kemampuan_pemahaman_ssw',
        'kelincahan_dalam_bekerja',
        'kekuatan_tindakan',
        'kemampuan_berbahasa_inggris',
        'kemampuan_berbahasa_inggris_lainnya',
        'kebugaran_jasmani_seminggu',
        'kebugaran_jasmani_seminggu_lainnya',
        'bersedia_kerja_shift',
        'bersedia_lembur',
        'bersedia_hari_libur',
        'menggunakan_kacamata',
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
        'istri_nama',
        'istri_usia',
        'istri_pekerjaan',
        'istri_gaji',
        'kontak_pasangan',
        'anak_nama',
        'anak_jenis_kelamin',
        'anak_usia',
        'anak_pendidikan',
        'ibu_nama',
        'ibu_usia',
        'ibu_pekerjaan',
        'ibu_gaji',
        'ayah_nama',
        'ayah_usia',
        'ayah_pekerjaan',
        'ayah_gaji',
        'kontak_orangtua',
        'kakak_nama',
        'kakak_usia',
        'kakak_jenis_kelamin',
        'kakak_pekerjaan',
        'kakak_status',
        'kakak_gaji',
        'adik_nama',
        'adik_usia',
        'adik_jenis_kelamin',
        'adik_pekerjaan',
        'adik_status',
        'rata_rata_penghasilan_keluarga',
    ];

    protected $casts = [
        'sertifikat_files' => 'array',
        'pas_foto' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function Pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    public function pendidikans()
    {
        return $this->hasMany(Pendidikan::class);
    }

    public function pengalamans()
    {
        return $this->hasMany(Pengalaman::class);
    }

    public function magangjisshu()
    {
        return $this->hasMany(MagangJisshu::class);
    }

    public function riwayatPekerjaanTerakhir()
    {
        return $this->hasMany(RiwayatPekerjaanTerakhir::class);
    }

    public function gajiKeluarga()
    {
        return $this->hasOne(GajiKeluarga::class);
    }

    public function getIstriGajiAttribute()
    {
        return $this->gajiKeluarga?->istri_gaji;
    }

    public function getIbuGajiAttribute()
    {
        return $this->gajiKeluarga?->ibu_gaji;
    }

    public function getAyahGajiAttribute()
    {
        return $this->gajiKeluarga?->ayah_gaji;
    }

    public function getKakakGajiAttribute()
    {
        return $this->gajiKeluarga?->kakak_gaji;
    }

    public function getAdikGajiAttribute()
    {
        return $this->gajiKeluarga?->adik_gaji;
    }

    public function tujuanSetelahPulang()
    {
        return $this->hasOne(TujuanSetelahPulang::class);
    }
}
