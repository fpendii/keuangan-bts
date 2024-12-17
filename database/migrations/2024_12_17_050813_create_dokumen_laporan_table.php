<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenLaporanTable extends Migration
{
    public function up()
    {
        Schema::create('dokumen_laporan', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->bigInteger('id_divisi')->unsigned();
            $table->string('nama_file');
            $table->string('deskripsi')->nullable();
            $table->date('tanggal_upload');
            $table->timestamps();

            $table->foreign('id_divisi')->references('id_divisi')->on('divisi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumen_laporan');
    }
}
