<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan_printing', function (Blueprint $table) {
            $table->id('id_pesanan_printing');
            // $table->bigInteger('id_pelanggan')->unsigned();
            // $table->bigInteger('id_layanan')->unsigned();
            $table->string('dokumen');
            $table->string('nama_pelanggan');
            $table->integer('jumlah');
            $table->string('warna');
            $table->string('kertas');
            $table->string('total_harga');
            $table->enum('status_store', ['proses', 'selesai']);
            $table->timestamps();

            // $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            // $table->foreign('id_layanan')->references('id_layanan')->on('layanan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan_printing');
    }
};
