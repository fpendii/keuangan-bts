<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanJilidController extends Controller
{

    public function jilid()
    {
        $transaksi = DB::table('pesanan_printing');
        dd($transaksi);


        return view('admin.laporan-keuangan.jilid.index',compact('transaksi_masuk', 'transaksi_keluar', 'total_pemasukan'));
    }

    public function tambah(){
        return view('admin.laporan-keuangan.jilid.tambah');
    }
}
