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
        Schema::table('puskesmas', function (Blueprint $table) {
            $table->string('kepala_puskesmas')->default('Kepala Puskesmas')->after('alamat_puskesmas');
            $table->string('nip_kepala')->default(000000000000)->after('kepala_puskesmas');
            $table->string('penanggung_jawab')->default('Penanggung Jawab')->after('nip_kepala');
            $table->string('nip_pj')->default(000000000000)->after('penanggung_jawab');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puskesmas', function (Blueprint $table) {
            //
        });
    }
};