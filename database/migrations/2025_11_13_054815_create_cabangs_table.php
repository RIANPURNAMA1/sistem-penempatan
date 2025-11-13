<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_cabang');
            $table->text('alamat');
            $table->timestamps(); // otomatis membuat created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cabangs');
    }
};
