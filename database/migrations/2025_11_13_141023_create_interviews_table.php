<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kandidat_id');
            $table->date('tanggal_interview');
            $table->enum('status_interview', ['Pending', 'Selesai', 'Ditolak'])->default('Pending');
            $table->unsignedInteger('jumlah_interview')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('kandidat_id')->references('id')->on('kandidats')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
