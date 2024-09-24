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
            $table->foreignId('id_puskesmas')->after('id_kelurahan');

            $table->foreign('id_puskesmas')->references('id')->on('puskesmas');
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