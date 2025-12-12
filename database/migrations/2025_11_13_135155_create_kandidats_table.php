<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kandidats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id'); // relasi ke pendaftar
            $table->unsignedBigInteger('cabang_id');
            $table->enum('status_kandidat', [
                'Job Matching',
                'Pending',
                'lamar_ke_perusahaan',
                'Interview',
                'Gagal Interview',
                'Jadwalkan Interview Ulang',
                'Lulus interview',
                'Pemberkasan',
                'Berangkat',
                'Ditolak',
            ])->default('Job Matching');
            $table->enum('status_kandidat_di_mendunia', [
                'Tetap di Mendunia',
                'Keluar dari Mendunia',
                'Sudah Terbang',
            ])->default('Tetap di Mendunia');

            $table->unsignedBigInteger('institusi_id')->nullable();
            
            // Kolom tambahan untuk tracking interview
            $table->unsignedInteger('jumlah_interview')->default(0);
            $table->string('nama_perusahaan')->nullable();
            $table->string('detail_pekerjaan')->nullable();
            $table->text('catatan_interview')->nullable();
            $table->date('jadwal_interview')->nullable();
            
            // Kolom tambahan untuk proses recruitment dan pemberkasan
            $table->date('tgl_setsumeikai_ichijimensetsu')->nullable()->comment('Tanggal Setsumeikai/Ichijimensetsu');
            $table->date('tgl_mensetsu')->nullable()->comment('Tanggal Mensetsu 1');
            $table->date('tgl_mensetsu2')->nullable()->comment('Tanggal Mensetsu 2');
            $table->text('catatan_mensetsu')->nullable()->comment('Catatan Mensetsu');
            $table->string('biaya_pemberkasan')->nullable()->comment('Biaya Pemberkasan');
            $table->string('adm_tahap1')->nullable()->comment('Administrasi Tahap 1');
            $table->date('dokumen_dikirim_soft_file')->nullable()->comment('Tanggal Dokumen Dikirim (Soft File)');
            $table->date('terbit_kontrak_kerja')->nullable()->comment('Tanggal Terbit Kontrak Kerja');
            $table->date('kontrak_dikirim_ke_tsk')->nullable()->comment('Tanggal Kontrak Dikirim ke TSK');
            $table->date('terbit_paspor')->nullable()->comment('Tanggal Terbit Paspor');
            $table->date('masuk_imigrasi_jepang')->nullable()->comment('Tanggal Masuk Imigrasi Jepang');
            $table->date('coe_terbit')->nullable()->comment('Tanggal COE Terbit');
            $table->string('adm_tahap2')->nullable()->comment('Administrasi Tahap 2');
            $table->date('pembuatan_ektkln')->nullable()->comment('Tanggal Pembuatan E-KTKLN');
            $table->date('dokumen_dikirim')->nullable()->comment('Tanggal Dokumen Dikirim');
            $table->date('visa')->nullable()->comment('Tanggal Visa');
            $table->date('jadwal_penerbangan')->nullable()->comment('Tanggal Jadwal Penerbangan');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kandidats');
    }
};