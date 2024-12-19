<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanJilidController extends Controller
{
    protected $id_divisi;
    public function jilid()
    {
        $transaksi_masuk = DB::table('transaksi')->where('jenis_transaksi', 'Pemasukan')->where('id_divisi', $this->id_divisi)->get();
        $transaksi_keluar = DB::table('transaksi')->where('jenis_transaksi', 'Pengeluaran')->where('id_divisi', $this->id_divisi)->get();

        $total_pemasukan = $transaksi_masuk->sum('jumlah') - $transaksi_keluar->sum('jumlah');
        return view('admin.laporan-keuangan.jilid.index',compact('transaksi_masuk', 'transaksi_keluar', 'total_pemasukan'));
    }
}
