<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanServisController extends Controller
{
    public function servis()
    {
        $transaksi = DB::table('pesanan_servis')->get();

        return view('admin.laporan-keuangan.servis.index',compact('transaksi'));
    }
}
