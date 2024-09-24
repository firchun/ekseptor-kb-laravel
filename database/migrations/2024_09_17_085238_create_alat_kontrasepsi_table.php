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
        Schema::create('alat_kontrasepsi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alat');
            $table->string('foto_alat')->nullable();
            $table->string('nama_alat');
            $table->text('cara_pakai');
            $table->text('kelebihan');
            $table->text('kekurangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat_kontrasepsi');
    }
};
