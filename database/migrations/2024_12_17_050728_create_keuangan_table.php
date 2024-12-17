<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuanganTable extends Migration
{
    public function up()
    {
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id('id_keuangan');
            $table->bigInteger('id_divisi')->unsigned();
            $table->date('tanggal');
            $table->decimal('total_pemasukan', 15, 2);
            $table->decimal('total_pengeluaran', 15, 2);
            $table->decimal('saldo', 15, 2);
            $table->timestamps();

            $table->foreign('id_divisi')->references('id_divisi')->on('divisi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('keuangan');
    }
}
