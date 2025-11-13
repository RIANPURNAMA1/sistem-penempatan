<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cabang_id');
            $table->string('nama');
            $table->string('email');
            $table->string('no_wa');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_daftar');
            $table->text('alamat');

            // Dokumen upload
            $table->string('foto');
            $table->string('kk');
            $table->string('ktp');
            $table->string('bukti_pelunasan');
            $table->string('akte');
            $table->string('izasah'); // ejaan sesuai form kamu

            // ✅ Status verifikasi admin
            $table->enum('verifikasi', [
                'menunggu',
                'data belum lengkap',
                'diterima',
                'ditolak'
            ])->default('menunggu')->comment('Status verifikasi oleh admin');

            // ✅ Catatan admin
            $table->text('catatan_admin')->nullable()->comment('Catatan atau alasan verifikasi oleh admin');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};