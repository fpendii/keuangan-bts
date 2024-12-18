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
        $transaksi_keluar = DB::table('transaksi')->where('jenis_transaksi', 'Pengeluaran')->where('id_divisi', $this->id_divisi)->get();

        $total_pemasukan = $transaksi_masuk->sum('jumlah') - $transaksi_keluar->sum('jumlah');


        return view('admin.laporan-keuangan.printing.index', compact('transaksi_masuk','transaksi_keluar','total_pemasukan'));
    }

    public function tambah()
    {
        return view('admin.laporan-keuangan.printing.tambah');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'total_harga' => 'required',
            'nama_dokument' => 'required',
        ]);

        $nama_dokument = $request->file('nama_dokument')->getClientOriginalName();

        $total_harga = str_replace('.', '', $request->total_harga);

        DB::table('transaksi')->insert([
            'id_divisi' => $this->id_divisi,
            'nama' => $request->nama_pelanggan,
            'jenis_transaksi' => 'Pemasukan',
            'jumlah' => $total_harga,
            'keterangan' => $nama_dokument,
            'tanggal_transaksi' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('admin/laporan-keuangan/printing')->with('success', 'Data berhasil disimpan');
    }
}
