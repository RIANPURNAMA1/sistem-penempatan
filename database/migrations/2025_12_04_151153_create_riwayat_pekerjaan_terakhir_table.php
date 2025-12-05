<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_pekerjaan_terakhir', function (Blueprint $table) {
            $table->id();

            // Relasi ke CV jika diperlukan
            $table->unsignedBigInteger('cv_id')->nullable();
            
            $table->string('nama_perusahaan')->nullable();
            $table->string('nama_kumiai')->nullable();
            $table->integer('total_karyawan')->nullable();
            $table->integer('total_karyawan_asing')->nullable();
            $table->string('bidang_pekerjaan')->nullable();
            $table->string('klasifikasi_pekerjaan')->nullable();

            // Masa Pelatihan: Tahun & Bulan
            $table->string('masa_pelatihan_mulai_tahun')->nullable();
            $table->string('masa_pelatihan_mulai_bulan')->nullable();
            $table->string('masa_pelatihan_selesai_tahun')->nullable();
            $table->string('masa_pelatihan_selesai_bulan')->nullable();

            $table->string('penanggung_jawab')->nullable();
            $table->string('shift_normal')->nullable(); // pilihan shift/normal

            // Jam Kerja (3 shift)
            $table->string('jam_kerja_mulai_1')->nullable();
            $table->string('jam_kerja_selesai_1')->nullable();

            $table->string('jam_kerja_mulai_2')->nullable();
            $table->string('jam_kerja_selesai_2')->nullable();

            $table->string('jam_kerja_mulai_3')->nullable();
            $table->string('jam_kerja_selesai_3')->nullable();

            $table->string('hari_libur')->nullable();
            $table->text('detail_pekerjaan')->nullable();
            $table->text('barang_cacat_action')->nullable();

            // Tempat Tinggal
            $table->string('prefektur')->nullable(); // -ken
            $table->string('kota')->nullable();       // -shi

            // Status visa sebelumnya
            $table->string('status_visa')->nullable();

            // Masa tinggal di Jepang sebelumnya
            $table->string('masa_tinggal_mulai_tahun')->nullable();
            $table->string('masa_tinggal_mulai_bulan')->nullable();
            $table->string('masa_tinggal_selesai_tahun')->nullable();
            $table->string('masa_tinggal_selesai_bulan')->nullable();

            // Gaji
            $table->integer('gaji_per_jam')->nullable();
            $table->integer('gaji_bersih')->nullable();

            // Lembur rata-rata
            $table->string('lembur_bulanan')->nullable(); // pilihan /bulan

            // Asrama
            $table->string('asrama_kamar')->nullable();
            $table->string('asrama_jumlah_orang')->nullable();

            // Transportasi
            $table->string('transportasi')->nullable();
            $table->integer('jarak_tempuh_menit')->nullable();

            // Hanko
            $table->string('punya_hanko')->nullable();
            $table->string('nama_hanko_sama_cv')->nullable();
            $table->string('nama_katakana_hanko')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_pekerjaan_terakhir');
    }
};
