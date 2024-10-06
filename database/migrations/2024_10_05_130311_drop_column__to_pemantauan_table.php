<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemantauan', function (Blueprint $table) {
            $table->dropColumn('pengguna_pil');
            $table->dropColumn('pengguna_suntik_1bln');
            $table->dropColumn('pengguna_suntik_3bln');
            $table->dropColumn('pengguna_akdr');
            $table->dropColumn('pengguna_impln');
            $table->dropColumn('pengguna_kdm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemantauan', function (Blueprint $table) {
            //
        });
    }
};
