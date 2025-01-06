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
}
