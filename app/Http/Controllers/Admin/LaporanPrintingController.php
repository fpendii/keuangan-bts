<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPrintingController extends Controller
{
    protected $id_divisi = 1;
    public function printing()
    {
        $transaksi_masuk = DB::table('transaksi')->where('jenis_transaksi', 'Pemasukan')->where('id_divisi', $this->id_divisi)->get();


        return view('admin.laporan-keuangan.printing.index', compact('transaksi_masuk'));
    }

    public function tambah()
    {
        return view('admin.laporan-keuangan.printing.tambah');
    }
}
