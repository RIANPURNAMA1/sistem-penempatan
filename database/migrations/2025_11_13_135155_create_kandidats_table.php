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
            $table->unsignedBigInteger('institusi_id')->nullable();
            // Kolom tambahan untuk tracking interview
            $table->unsignedInteger('jumlah_interview')->default(0);
            $table->string('nama_perusahaan');
            $table->string('detail_pekerjaan');
            $table->text('catatan_interview')->nullable();
            $table->date('jadwal_interview')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kandidats');
    }
};
