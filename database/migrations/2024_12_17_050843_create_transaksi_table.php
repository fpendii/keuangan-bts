<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->bigInteger('id_divisi')->unsigned();
            $table->string('nama');
            $table->enum('jenis_transaksi', ['Pemasukan', 'Pengeluaran']);
            $table->decimal('jumlah', 15, 2);
            $table->decimal('total', 15, 2);
            $table->text('keterangan');
            $table->date('tanggal_transaksi');
            $table->timestamps();

            $table->foreign('id_divisi')->references('id_divisi')->on('divisi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}

