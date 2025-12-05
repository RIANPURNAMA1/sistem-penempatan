<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('magang_jisshu', function (Blueprint $table) {
            $table->id();

            // Relasi ke CV
            $table->unsignedBigInteger('cv_id');

            // Data Magang Eks Jisshu
            $table->string('perusahaan')->nullable();
            $table->string('kota_prefektur')->nullable();
            $table->string('bidang')->nullable();

            // Tahun Bulan: Format YYYY-MM
            $table->string('tahun_mulai')->nullable();
            $table->string('tahun_selesai')->nullable();

            $table->timestamps();

            // Relasi & Cascade delete
            $table->foreign('cv_id')
                  ->references('id')
                  ->on('cvs')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('magang_jisshu');
    }
};
