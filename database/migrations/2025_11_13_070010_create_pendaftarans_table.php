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
            $table->string('usia');
            $table->string('agama');
            $table->enum('status', ['belum menikah', 'menikah', 'lajang']);
            $table->string('email');
            $table->string('no_wa');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_daftar');
            $table->date('tempat_tanggal_lahir');
            $table->string('tempat_lahir');
            $table->text('alamat');

            // Lokasi lengkap
            $table->string('provinsi', 100);
            $table->string('kab_kota', 100);
            $table->string('kecamatan', 100);
            $table->string('kelurahan', 100);


            // Tambahan sesuai permintaan
            $table->string('id_prometric')->nullable();
            $table->string('password_prometric')->nullable();
            $table->enum('pernah_ke_jepang', ['Ya', 'Tidak'])->default('Tidak');
            $table->string('paspor')->nullable()->comment('Upload paspor jika sudah memiliki');

            // Dokumen upload (semua wajib)
            $table->string('foto');
            $table->string('sertifikat_jft');
            $table->string('sertifikat_ssw');
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
