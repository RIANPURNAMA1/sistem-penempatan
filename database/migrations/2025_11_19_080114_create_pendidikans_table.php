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
        $table->year('tahun_masuk')->nullable(); // Tahun masuk
        $table->year('tahun_lulus')->nullable(); // Tahun lulus
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
