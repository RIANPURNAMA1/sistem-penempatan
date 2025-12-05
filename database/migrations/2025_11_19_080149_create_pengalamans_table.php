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
        Schema::create('pengalamans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cv_id');
            $table->string('perusahaan');
            $table->string('jabatan')->nullable();
            $table->string('tanggal_masuk')->nullable();   // Tanggal masuk kerja
            $table->string('tanggal_keluar')->nullable();  // Tanggal keluar kerja
            $table->string('gaji')->nullable();
            $table->string('kota')->nullable();            // Nama kota
            $table->timestamps();

            $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengalamans');
    }
};
