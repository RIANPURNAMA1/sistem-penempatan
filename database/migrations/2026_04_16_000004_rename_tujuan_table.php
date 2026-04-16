<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('RENAME TABLE tujuan_setelah_pulang TO tujuan_setelah_pulangs');
    }

    public function down(): void
    {
        DB::statement('RENAME TABLE tujuan_setelah_pulangs TO tujuan_setelah_pulang');
    }
};
