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

            // Identitas dasar
            $table->string('nik', 20)->unique(); // NIK unik dan wajib
            $table->string('nama');
            $table->string('email');
            $table->string('no_wa');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_daftar');
            $table->text('alamat');

            // Lokasi lengkap
            $table->string('provinsi', 100);
            $table->string('kab_kota', 100);
            $table->string('kecamatan', 100);
            $table->string('kelurahan', 100);

            // Dokumen upload (semua wajib)
            $table->string('foto');
            $table->string('kk');
            $table->string('ktp');
            $table->string('bukti_pelunasan');
            $table->string('akte');
            $table->string('ijasah'); // ejaan sesuai form kamu

            // Status verifikasi admin
            $table->enum('verifikasi', [
                'menunggu',
                'data belum lengkap',
                'diterima',
                'ditolak'
            ])->default('menunggu')->comment('Status verifikasi oleh admin');

            // Catatan admin
            $table->text('catatan_admin')->nullable()->comment('Catatan atau alasan verifikasi oleh admin');

            $table->timestamps();

        
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
