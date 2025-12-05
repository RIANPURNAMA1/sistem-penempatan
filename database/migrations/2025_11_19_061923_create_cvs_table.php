<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            // HALAMAN 1 - Data Awal
            $table->string('email');
            $table->unsignedBigInteger('cabang_id');
            $table->string('batch');
            $table->string('no_telepon');
            $table->string('no_orang_tua');
            $table->enum('bidang_sertifikasi', [
                'Pengolahan Makanan',
                'Pertanian',
                'Kaigo (perawat)',
                'Building Cleaning',
                'Restoran',
                'Driver',
                'Hanya JFT'
            ]);
            $table->string('bidang_sertifikasi_lainnya')->nullable();
            $table->enum('program_pertanian_kawakami', ['Ya', 'Tidak']);
            $table->json('sertifikat_files')->nullable();

            // HALAMAN 2 - Pengisian Data Diri
            $table->json('pas_foto')->nullable();
            $table->string('pas_foto_cv');

            $table->string('nama_lengkap_romaji');
            $table->string('nama_lengkap_katakana');
            $table->string('nama_panggilan_romaji');
            $table->string('nama_panggilan_katakana');
            $table->enum('jenis_kelamin', ['男 (Laki-laki)', '女 (Perempuan)']);
            $table->string('agama');
            $table->string('agama_lainnya')->nullable();
            $table->string('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('usia');
            $table->text('alamat_lengkap');
            // Wilayah Domisili (diambil dari API saat input)
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();

            $table->string('email_aktif');
            $table->enum('status_perkawinan', ['Sudah Menikah', 'Belum Menikah']);
            $table->string('status_perkawinan_lainnya')->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            $table->enum('surat_izin_mengemudi', ['Ada', 'Tidak']);
            $table->enum('jenis_sim', ['SIM A', 'SIM B', 'SIM C', 'SIM D'])->nullable();
            $table->enum('merokok', ['Ya', 'Tidak']);
            $table->enum('minum_alkohol', ['Ya', 'Tidak']);
            $table->enum('bertato', ['Ya', 'Tidak']);
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->string('ukuran_pinggang');
            $table->string('ukuran_sepatu');
            $table->enum('ukuran_atasan_baju', ['XS', 'S', 'M', 'L', 'XL', 'XXL']);
            $table->string('ukuran_atasan_baju_lainnya')->nullable();
            $table->enum('ukuran_celana', ['XS', 'S', 'M', 'L', 'XL', 'XXL']);
            $table->enum('tangan_dominan', ['Kanan', 'Kiri']);
            $table->enum('kemampuan_penglihatan_mata', ['Minus', 'Normal', 'Silinders']);
            $table->enum('kemampuan_pendengaran', [
                'Normal',
                'Sedang',
                'Kurang',
                'Tuli Ringan',
                'Tuli Berat'
            ])->default('Normal');
            $table->string('kemampuan_penglihatan_mata_lainnya')->nullable();
            $table->enum('sudah_vaksin_berapa_kali', ['1x Vaksin', '2x Vaksin', '3x Vaksin']);
            $table->string('sudah_vaksin_berapa_kali_lainnya')->nullable();
            $table->text('kesehatan_badan');
            $table->text('penyakit_cedera_masa_lalu');
            $table->text('hobi');
            $table->enum('rencana_sumber_biaya_keberangkatan', [
                'Dana talang LPK',
                'Dana Pribadi',
                'Dana Ortu',
                'Dana pinjaman pihak lain'
            ]);
            $table->enum('perkiraan_biaya', [
                '10.000.000 - 20.000.000',
                '20.000.000 - 30.000.000',
                '30.000.000 - 40.000.000'
            ]);
            $table->string('Biaya_keberangkatan_sebelumnya_jisshu')->nullable();

            // HALAMAN 3 - Pembelajaran di Mendunia
            $table->string('lama_belajar_di_mendunia');

            // ==== ENUM RAWAN ERROR → STRING (FIX) ====
            $table->string('kemampuan_bahasa_jepang')->nullable();
            $table->string('kemampuan_pemahaman_ssw')->nullable();
            $table->string('kelincahan_dalam_bekerja')->nullable();
            $table->string('kekuatan_tindakan')->nullable();
            $table->string('kemampuan_berbahasa_inggris')->nullable();

            $table->string('kemampuan_berbahasa_inggris_lainnya')->nullable();

            $table->enum('kebugaran_jasmani_seminggu', [
                '3 kali/1 minggu',
                '4 Kali/1 minggu',
                '5 Kali/1 minggu',
                '10 Kali/1 minggu'
            ]);
            $table->string('kebugaran_jasmani_seminggu_lainnya')->nullable();


            // lembur
            // HALAMAN 2 - Tambahan Pertanyaan Kerja
            $table->enum('bersedia_kerja_shift', ['Ya', 'Tidak'])->default('Tidak');
            $table->enum('bersedia_lembur', ['Ya', 'Tidak'])->default('Tidak');
            $table->enum('bersedia_hari_libur', ['Ya', 'Tidak'])->default('Tidak');
            $table->enum('menggunakan_kacamata', ['Ya', 'Tidak'])->default('Tidak');

            // HALAMAN 5 - Daya Tarik Perusahaan
            $table->enum('ada_keluarga_di_jepang', ['Ya', 'Tidak']);
            $table->enum('hubungan_keluarga_di_jepang', ['Ayah', 'Ibu', 'Paman', 'Kakak', 'Adik', 'Bibi', 'Kakek', 'Nenek', 'Tidak ada'])->nullable();
            $table->enum('status_kerabat_di_jepang', ['TG 1', 'Jishusei 1', 'Jishusei 2', 'Jishusei 3', 'EIJU', 'Tokutei katsudou', 'Tidak ada'])->nullable();
            $table->string('status_kerabat_di_jepang_lainnya')->nullable();
            $table->enum('ingin_bekerja_berapa_tahun', ['2 Tahun', '3 Tahun', '4 Tahun', '5 Tahun']);
            $table->string('ingin_bekerja_berapa_tahun_lainnya')->nullable();
            $table->enum('ingin_pulang_berapa_kali', ['1-2 Kali', '2 - 3 Kali', '4-5 Kali']);
            $table->text('kelebihan_diri');
            $table->text('komentar_guru_kelebihan_diri');
            $table->text('kekurangan_diri');
            $table->text('komentar_guru_kekurangan_diri');
            $table->text('ketertarikan_terhadap_jepang');
            $table->text('orang_yang_dihormati');
            $table->text('point_plus_diri');
            $table->text('keahlian_khusus');


            // ===============================
            // HALAMAN 6 - Data Anggota Keluarga
            // ===============================

            // ISTRI
            $table->string('istri_nama')->nullable();
            $table->string('istri_usia')->nullable();
            $table->string('istri_pekerjaan')->nullable();

            // ANAK
            $table->string('anak_nama')->nullable();
            $table->string('anak_jenis_kelamin')->nullable();
            $table->string('anak_usia')->nullable();
            $table->string('anak_pendidikan')->nullable();

            // IBU
            $table->string('ibu_nama');
            $table->string('ibu_usia');
            $table->string('ibu_pekerjaan');

            // AYAH
            $table->string('ayah_nama');
            $table->string('ayah_usia');
            $table->string('ayah_pekerjaan');

            // KAKAK
            $table->string('kakak_nama')->nullable();
            $table->string('kakak_usia')->nullable();
            $table->string('kakak_jenis_kelamin')->nullable();
            $table->string('kakak_pekerjaan')->nullable();
            $table->string('kakak_status')->nullable(); // kandung / tiri

            // ADIK
            $table->string('adik_nama')->nullable();
            $table->string('adik_usia')->nullable();
            $table->string('adik_jenis_kelamin')->nullable();
            $table->string('adik_pekerjaan')->nullable();
            $table->string('adik_status')->nullable(); // kandung / tiri

            // PENGHASILAN KELUARGA
            $table->string('rata_rata_penghasilan_keluarga');


            $table->timestamps();
            $table->softDeletes();

            $table->index('created_at');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
