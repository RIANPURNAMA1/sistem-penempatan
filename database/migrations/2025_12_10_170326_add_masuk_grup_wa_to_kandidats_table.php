<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('kandidats', function (Blueprint $table) {
        $table->boolean('masuk_grup_wa')->default(false)->after('status_kandidat');
    });
}

public function down()
{
    Schema::table('kandidats', function (Blueprint $table) {
        $table->dropColumn('masuk_grup_wa');
    });
}


};
