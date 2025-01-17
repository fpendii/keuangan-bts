<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan_bimbel', function (Blueprint $table) {
            $table->id('id_pesanan_bimbel');
            // $table->bigInteger('id_pelanggan')->unsigned();
            $table->bigInteger('id_layanan')->unsigned();
            $table->string('jenis_bimbel');
            $table->string('nama_pelanggan');
            $table->string('judul_projek');
            $table->string('total_harga');
            $table->timestamps();

            // $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            // $table->foreign('id_layanan')->references('id_layanan')->on('layanan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan_bimbel');
    }
};
