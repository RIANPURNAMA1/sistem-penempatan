<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kandidat_histories', function (Blueprint $table) {
            $table->id();

            // relasi ke kandidat
            $table->unsignedBigInteger('kandidat_id');

            // semua status wajib lengkap agar tidak terjadi error
            $table->enum('status_kandidat', [
                'Job Matching',
                'Pending',
                'Interview',
                'Jadwalkan Interview Ulang',
                'Lulus interview',
                'Gagal Interview',
                'Pemberkasan',
                'Berangkat',
                'Diterima',
                'Ditolak',
            ]);

            // mapping status interview
            $table->enum('status_interview', [
                'Pending',
                'Proses',
                'Selesai',
                'Gagal',
            ]);

            $table->unsignedBigInteger('institusi_id')->nullable();
            $table->text('catatan_interview')->nullable();
            $table->date('jadwal_interview')->nullable();
            $table->timestamps();

            $table->foreign('kandidat_id')
                  ->references('id')
                  ->on('kandidats')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kandidat_histories');
    }
};
