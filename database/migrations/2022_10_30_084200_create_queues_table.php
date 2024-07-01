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
        Schema::create('queues', function (Blueprint $table) {
            $table->id('id_antrian');
            $table->char('id_pasien', 5)->unique()->nullable();
            $table->foreign('id_pasien')->references('id_pasien')->on('patients');
            $table->char('id_poli', 5)->nullable();
            $table->foreign('id_poli')->references('id_poli')->on('polies');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('queues');
    }
};
