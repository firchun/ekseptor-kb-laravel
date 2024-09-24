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
        Schema::create('sasaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_puskesmas');
            $table->foreignId('id_kelurahan');
            $table->integer('pus_miskin');
            $table->integer('pus_4t');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('id_puskesmas')->references('id')->on('puskesmas');
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
        Schema::dropIfExists('puskesmas_pus');
    }
};
