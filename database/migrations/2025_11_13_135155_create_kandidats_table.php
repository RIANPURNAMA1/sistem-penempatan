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
                'Berangkat',
                'Diterima',
                'Ditolak',
            ])->default('Job Matching');
            $table->enum('status_interview', [
                'Pending',
                'Selesai',
                'Gagal',
                'Jadwalkan Interview Ulang',
            ])->default('Pending');
            $table->unsignedBigInteger('institusi_id')->nullable();
            // Kolom tambahan untuk tracking interview
            $table->unsignedInteger('jumlah_interview')->default(0);
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
