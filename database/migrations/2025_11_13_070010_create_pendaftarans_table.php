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

            // Identitas dasar (NIK, Nama, Email, No WA, Tanggal Daftar wajib diisi)
            $table->string('nik', 20)->unique(); // NIK unik dan wajib
            $table->string('nama');

            // Kolom yang dibuat nullable (opsional)
            $table->string('usia')->nullable();
            $table->string('agama')->nullable();


            $table->enum('status', ['belum menikah', 'menikah', 'lajang'])->nullable();

            $table->string('email');
            $table->string('no_wa');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            // Kolom Tanggal/Lokasi (dibuat nullable untuk import yang tidak lengkap)
            $table->date('tempat_tanggal_lahir')->nullable(); // FIX: Menghilangkan ->change()
            $table->string('tempat_lahir')->nullable(); // FIX: Menghilangkan ->change()
            $table->text('alamat')->nullable(); // FIX: Menghilangkan ->change()
            $table->string('pendidikan_terakhir');


            // Lokasi lengkap (dibuat nullable)
            $table->string('provinsi', 100)->nullable(); // FIX: Menghilangkan ->change()
            $table->string('kab_kota', 100)->nullable(); // FIX: Menghilangkan ->change()
            $table->string('kecamatan', 100)->nullable(); // FIX: Menghilangkan ->change()
            $table->string('kelurahan', 100)->nullable(); // FIX: Menghilangkan ->change()


            // Tambahan sesuai permintaan
            $table->string('id_prometric')->nullable();
            $table->string('password_prometric')->nullable();
            $table->enum('pernah_ke_jepang', ['Ya', 'Tidak'])->default('Tidak');
            $table->string('paspor')->nullable()->comment('Upload paspor jika sudah memiliki');

            $table->enum('status_jft', ['belum ujian jft', 'sudah ujian jft'])
                ->default('belum ujian jft');

            $table->enum('status_ssw', ['belum ujian ssw', 'sudah ujian ssw'])
                ->default('belum ujian ssw');


            // Dokumen upload (dibuat nullable)
            $table->string('foto')->nullable(); // FIX: Menghilangkan ->change()
            $table->string('sertifikat_jft')->nullable(); // FIX: Menghilangkan ->change()
            $table->string('sertifikat_ssw')->nullable(); // FIX: Menghilangkan ->change()
            $table->string('kk')->nullable(); // FIX: Menghilangkan ->change()
            $table->string('ktp')->nullable(); // FIX: Menghilangkan ->change()
            $table->string('bukti_pelunasan')->nullable(); // FIX: Menghilangkan ->change()
            $table->string('akte')->nullable(); // FIX: Menghilangkan ->change()
            $table->string('ijasah')->nullable(); // FIX: Menghilangkan ->change()

            // Status verifikasi admin
            $table->enum('verifikasi', [
                'menunggu',
                'data belum lengkap',
                'diterima',
                'ditolak'
            ])->default('menunggu')->comment('Status verifikasi oleh admin');

            // Catatan admin sudah nullable
            $table->text('catatan_admin')->nullable()->comment('Catatan atau alasan verifikasi oleh admin');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
