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
        Schema::table('ekseptor', function (Blueprint $table) {
            $table->dropForeign(['id_alat_kontrasepsi']);
            $table->dropColumn('id_alat_kontrasepsi');
            $table->dropColumn('tanggal_pemakaian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ekseptor', function (Blueprint $table) {
            //
        });
    }
};
