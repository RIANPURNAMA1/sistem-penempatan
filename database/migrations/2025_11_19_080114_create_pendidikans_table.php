<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendidikans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cv_id');
            $table->string('nama');             // Nama sekolah/universitas
            $table->string('jurusan')->nullable(); // Jurusan (opsional)
            $table->string('tahun_masuk', 7)->nullable(); // Tahun masuk (format: YYYY-MM)
            $table->string('tahun_lulus', 7)->nullable(); // Tahun lulus (format: YYYY-MM)
            $table->timestamps();

            $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikans');
    }
};
