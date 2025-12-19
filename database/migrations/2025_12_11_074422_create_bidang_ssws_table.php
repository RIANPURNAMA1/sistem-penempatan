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
        Schema::create('bidang_ssws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id')->nullable();
            $table->unsignedBigInteger('kandidat_id')->nullable();
            $table->enum('nama_bidang', [
                'Pengolahan makanan',
                'Restoran',
                'Pertanian',
                'Kaigo (perawat)',
                'Building cleaning',
                'Driver',
                'Lainnya',
            ])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidang_ssws');
    }
};
