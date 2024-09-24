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
        Schema::create('pemantauan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelurahan');
            //terima
            $table->integer('terima_pil')->default(0);
            $table->integer('terima_suntik')->default(0);
            $table->integer('terima_akdr')->default(0);
            $table->integer('terima_impln')->default(0);
            $table->integer('terima_kdm')->default(0);
            //penggunaan
            $table->integer('pengguna_pil')->default(0);
            $table->integer('pengguna_suntik_1bln')->default(0);
            $table->integer('pengguna_suntik_3bln')->default(0);
            $table->integer('pengguna_akdr')->default(0);
            $table->integer('pengguna_impln')->default(0);
            $table->integer('pengguna_kdm')->default(0);
            $table->timestamps();

            $table->foreign('id_kelurahan')->references('id')->on('kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemantauan');
    }
};