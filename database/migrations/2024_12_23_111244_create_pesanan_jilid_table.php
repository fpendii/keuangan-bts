<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanan_jilid', function (Blueprint $table) {
            $table->id('id_pesanan_jilid');
            // $table->bigInteger('id_pelanggan')->unsigned();
            // $table->bigInteger('id_layanan')->unsigned();
            $table->string('dokumen');
            $table->string('jenis_jilid');
            $table->integer('jumlah');
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();

            // $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            // $table->foreign('id_layanan')->references('id_layanan')->on('layanan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanan_jilid');
    }
};
