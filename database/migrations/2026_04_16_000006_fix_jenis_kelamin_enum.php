<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE cvs MODIFY COLUMN jenis_kelamin VARCHAR(50) NOT NULL');

        DB::statement("UPDATE cvs SET jenis_kelamin = 'Laki-laki' WHERE jenis_kelamin = '男 (Laki-laki)'");
        DB::statement("UPDATE cvs SET jenis_kelamin = 'Perempuan' WHERE jenis_kelamin = '女 (Perempuan)'");

        DB::statement("ALTER TABLE cvs MODIFY COLUMN jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL");
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE cvs MODIFY COLUMN jenis_kelamin VARCHAR(50) NOT NULL');

        DB::statement("UPDATE cvs SET jenis_kelamin = '男 (Laki-laki)' WHERE jenis_kelamin = 'Laki-laki'");
        DB::statement("UPDATE cvs SET jenis_kelamin = '女 (Perempuan)' WHERE jenis_kelamin = 'Perempuan'");

        DB::statement("ALTER TABLE cvs MODIFY COLUMN jenis_kelamin ENUM('男 (Laki-laki)', '女 (Perempuan)') NOT NULL");
    }
};
