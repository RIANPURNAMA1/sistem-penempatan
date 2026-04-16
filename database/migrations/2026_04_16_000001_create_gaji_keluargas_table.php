<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gaji_keluargas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cv_id');
            $table->string('istri_gaji')->nullable();
            $table->string('ibu_gaji')->nullable();
            $table->string('ayah_gaji')->nullable();
            $table->string('kakak_gaji')->nullable();
            $table->string('adik_gaji')->nullable();
            $table->timestamps();

            $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gaji_keluargas');
    }
};
