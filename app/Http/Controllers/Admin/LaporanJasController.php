<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanJasController extends Controller
{
    public function jas()
    {
        $transaksi = DB::table('pesanan_jas')->get();

        return view('admin.laporan-keuangan.jas.index', compact('transaksi'));
    }

    public function tambah()
    {
        return view('admin.laporan-keuangan.jas.tambah');
    }

    public function simpan(Request $request)
    {
        $request->validate(
            [
                'nama_pelanggan' => 'required',
                'ukuran_jas' => 'required',
                'jumlah' => 'required|numeric|min:1',
                'total_harga' => 'required|numeric|min:1',
            ],
            [
                'nama_pelanggan.required' => 'Nama pelanggan harus diisi.',
                'ukuran_jas.required' => 'Ukuran jas harus diisi.',
                'jumlah.required' => 'Jumlah lembar harus diisi.',
                'jumlah.numeric' => 'Jumlah lembar harus berupa angka.',
                'jumlah.min' => 'Jumlah lembar minimal 1.',
                'total_harga.required' => 'Total harga harus diisi.',
                'total_harga.numeric' => 'Total harga harus berupa angka.',
                'total_harga.min' => 'Total harga minimal 1.',
            ]
        );

        $total_harga = str_replace('.', '', $request->total_harga);

        DB::table('pesanan_jas')->insert([
            'nama_pelanggan' => $request->nama_pelanggan,
            'ukuran_jas' => $request->ukuran_jas,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('admin/laporan-keuangan/jas')->with('success', 'Data berhasil disimpan');
    }
}
