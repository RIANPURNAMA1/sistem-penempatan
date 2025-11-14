<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institusis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_institusi');
            $table->text('alamat');
            $table->string('penanggung_jawab');
            $table->string('no_wa', 20);
            $table->integer('kuota')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institusis');
    }
};
