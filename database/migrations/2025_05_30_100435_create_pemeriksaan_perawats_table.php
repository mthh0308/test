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
        Schema::create('pemeriksaanperawat_t', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->float('beratbadan')->nullable();
            $table->float('tinggibadan')->nullable();
            $table->string('tekanandarah')->nullable();
            $table->float('suhu')->nullable();
            $table->integer('nadi')->nullable();
            $table->integer('pernafasan')->nullable();
            $table->dateTime('tglperiksa');
            $table->timestamps();

            $table->foreign('id_pasien')->references('id')->on('pasien_m')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaan_perawats');
    }
};
