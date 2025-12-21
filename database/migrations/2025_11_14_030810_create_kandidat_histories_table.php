<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kandidat_histories', function (Blueprint $table) {
            $table->id();

            // relasi ke kandidat
            $table->unsignedBigInteger('kandidat_id');
            
            // Status yang wajib ada, DITAMBAHKAN 'lamar_ke_perusahaan'
            // CATATAN: Status 'Diterima' tidak ada di controller/migration sebelumnya, 
            // saya hilangkan agar konsisten dengan ENUM di tabel kandidats.
            $table->enum('status_kandidat', [
                'Job Matching',
                'Pending',
                'lamar ke perusahaan', // <--- DITAMBAHKAN
                'Interview',
                'Jadwalkan Interview Ulang',
                'Lulus interview',
                'Gagal Interview',
                'Pemberkasan',
                'Berangkat',
                'Ditolak',
            ]);
            
            // KOLOM HILANG YANG MENYEBABKAN ERROR 'nama_perusahaan' di controller
            $table->string('nama_perusahaan')->nullable(); 
            $table->string('detail_pekerjaan')->nullable(); 

             $table->text('bidang_ssw')->nullable();

            // mapping status interview
            $table->enum('status_interview', [
                'Pending',
                'Proses',
                'Selesai',
                'Gagal',
            ]);

            $table->unsignedBigInteger('institusi_id')->nullable();
            $table->text('catatan_interview')->nullable();
            $table->date('jadwal_interview')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('kandidat_id')
                ->references('id')
                ->on('kandidats')
                ->onDelete('cascade');
                
            // Disarankan: Foreign Key untuk institusi_id
            $table->foreign('institusi_id')
                ->references('id')
                ->on('institusis')
                ->onDelete('set null'); // Menggunakan set null karena kolomnya nullable
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kandidat_histories');
    }
};