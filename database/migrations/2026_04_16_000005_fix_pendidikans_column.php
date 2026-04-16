<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE pendidikans MODIFY COLUMN tahun_masuk VARCHAR(7) NULL');
        DB::statement('ALTER TABLE pendidikans MODIFY COLUMN tahun_lulus VARCHAR(7) NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE pendidikans MODIFY COLUMN tahun_masuk YEAR NULL');
        DB::statement('ALTER TABLE pendidikans MODIFY COLUMN tahun_lulus YEAR NULL');
    }
};
