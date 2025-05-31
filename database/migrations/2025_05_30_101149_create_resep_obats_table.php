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
        Schema::create('resepobat_t', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_obat');
            $table->integer('jumlah');
            $table->dateTime('tglresep');
            $table->timestamps();

            $table->foreign('id_pasien')->references('id')->on('pasien_m')->onDelete('cascade');
            $table->foreign('id_obat')->references('id')->on('obat_m')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resep_obats');
    }
};
