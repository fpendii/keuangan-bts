<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanBimbelController extends Controller
{
    public function bimbel(){

        $transaksi = DB::table('pesanan_bimbel')->get();

        return view('admin.laporan-keuangan.bimbel.index', compact('transaksi'));
    }

    public function tambah(){
        return view('admin.laporan-keuangan.bimbel.tambah');
    }

    public function edit($id){
        $transaksi = DB::table('pesanan_bimbel')->where('id_pesanan_bimbel', $id)->first();

        return view('admin.laporan-keuangan.bimbel.edit', compact('transaksi'));
    }
}
