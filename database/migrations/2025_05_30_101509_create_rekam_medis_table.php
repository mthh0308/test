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
    public function up(): void
    {
        Schema::create('rekammedis_t', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_pemeriksaanperawat')->nullable();
            $table->unsignedBigInteger('id_pemeriksaandokter')->nullable();
            $table->unsignedBigInteger('id_resepobat')->nullable();
            $table->date('tgl_rekammedis');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_pasien')->references('id')->on('pasien_m')->onDelete('cascade');
            $table->foreign('id_pemeriksaanperawat')->references('id')->on('pemeriksaanperawat_t')->onDelete('set null');
            $table->foreign('id_pemeriksaandokter')->references('id')->on('pemeriksaandokter_t')->onDelete('set null');
            $table->foreign('id_resepobat')->references('id')->on('resepobat_t')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekam_medis');
    }
};
