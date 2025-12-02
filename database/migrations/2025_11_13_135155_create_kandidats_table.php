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
                'Interview',
                'Gagal Interview',
                'Jadwalkan Interview Ulang',
                'Lulus interview',
                'Pemberkasan',
                'Berangkat',
                'Ditolak',
            ])->default('Job Matching');

            // ENUM Bidang SSW
            $table->enum('bidang_ssw', [
                'Pengolahan makanan',
                'Restoran',
                'Pertanian',
                'Kaigo (perawat)',
                'Building cleaning',
                'Driver',
                'Lainnya',
            ])->nullable(); // jika ingin wajib tinggal hapus nullable()
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
