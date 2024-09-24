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
        Schema::create('ekseptor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_alat_kontrasepsi');
            $table->string('nama');
            $table->date('tanggal_pemakaian');
            $table->date('tanggal_lahir');
            $table->string('pendidikan');
            $table->string('alamat');
            $table->integer('jumlah_anak');
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->string('no_bpjs');
            $table->string('nik');
            $table->enum('jenis_ras', ['OAP', 'NON-OAP'])->default('OAP');
            $table->timestamps();

            $table->foreign('id_alat_kontrasepsi')->references('id')->on('alat_kontrasepsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ekseptor');
    }
};
