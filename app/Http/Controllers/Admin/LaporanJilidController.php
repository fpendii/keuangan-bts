<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanJilidController extends Controller
{

    public function jilid()
    {
        $transaksi = DB::table('pesanan_jilid')->get();


        return view('admin.laporan-keuangan.jilid.index', compact('transaksi'));
    }

    public function tambah()
    {
        return view('admin.laporan-keuangan.jilid.tambah');
    }

    public function edit($id){
        $transaksi = DB::table('pesanan_jilid')->where('id_pesanan_jilid', $id)->first();

        return view('admin.laporan-keuangan.jilid.edit', compact('transaksi'));
    }
}
