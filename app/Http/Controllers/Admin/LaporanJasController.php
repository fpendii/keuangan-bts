<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanJasController extends Controller
{
    public function jas(){
        $transaksi = DB::table('pesanan_jas')->get();

        return view('admin.laporan-keuangan.jas.index',compact('transaksi'));
    }

    public function tambah(){
        return view('admin.laporan-keuangan.jas.tambah');
    }
}
