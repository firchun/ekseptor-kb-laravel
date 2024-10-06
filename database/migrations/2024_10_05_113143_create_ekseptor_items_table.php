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
        Schema::create('ekseptor_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ekseptor');
            $table->enum('penggunaan', [
                'pil',
                'suntik_1bln',
                'suntik_3bln',
                'akdr',
                'impln',
                'kndm'
            ]);
            $table->timestamps();

            $table->foreign('id_ekseptor')->references('id')->on('ekseptor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ekseptor_items');
    }
};
