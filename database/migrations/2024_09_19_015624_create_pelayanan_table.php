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
        Schema::create('pelayanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kelurahan');
            $table->foreignId('id_puskesmas');
            $table->integer('kb_aktif')->default(0);
            $table->integer('komplikasi')->default(0);
            $table->integer('kegagalan')->default(0);
            $table->integer('dropout')->default(0);
            $table->integer('pus_miskin')->default(0);
            $table->integer('pus_4t')->default(0);
            $table->timestamps();

            $table->foreign('id_kelurahan')->references('id')->on('kelurahan');
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
        Schema::dropIfExists('pelayanan');
    }
};