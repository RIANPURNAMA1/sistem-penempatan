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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('google_id')->nullable();

            $table->enum('role', [
                'Cabang Cianjur Selatan Mendunia',
                'Cabang Cianjur Pamoyanan Mendunia',
                'Cabang Batam Mendunia',
                'Cabang Banyuwangi Mendunia',
                'Cabang Kendal Mendunia',
                'Cabang Pati Mendunia',
                'Cabang Tulung Agung Mendunia',
                'Cabang Bangkalan Mendunia',
                'Cabang Bojonegoro Mendunia',
                'Cabang Jember Mendunia',
                'Cabang Wonosobo Mendunia',
                'Cabang Eshan Mendunia',
                'super-admin',
                'kandidat'
            ])->default('kandidat');

            $table->unsignedBigInteger('cabang_id')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
