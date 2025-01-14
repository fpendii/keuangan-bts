<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanBimbelController extends Controller
{
    public function bimbel()
    {
        $transaksi = DB::table('pesanan_bimbel')->get();
        $totalPendapatanBulanIni = DB::table('pesanan_bimbel')
            ->whereMonth('created_at', date('m')) // Filter berdasarkan bulan
            ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun
            ->sum('total_harga');
        return view('admin.laporan-keuangan.bimbel.index', compact('transaksi','totalPendapatanBulanIni'));
    }

    public function tambah()
    {
        return view('admin.laporan-keuangan.bimbel.tambah');
    }

    public function simpan(Request $request){
        $request->validate(
            [
                'nama_pelanggan' => 'required',
                'jenis_bimbel' => 'required',
                'judul_projek' => 'required',
                'total_harga' => 'required|numeric|min:1',
            ],
            [
                'nama_pelanggan.required' => 'Nama pelanggan harus diisi.',
                'jenis_bimbel.required' => 'Jenis bimbel harus diisi.',
                'judul_projek.required' => 'Judul projek harus diisi.',
                'total_harga.required' => 'Total harga harus diisi.',
                'total_harga.numeric' => 'Total harga harus berupa angka.',
                'total_harga.min' => 'Total harga minimal 1.',
            ]
        );

        $total_harga = str_replace('.', '', $request->total_harga);

        DB::table('pesanan_bimbel')->insert([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_bimbel' => $request->jenis_bimbel,
            'judul_projek' => $request->judul_projek,
            'total_harga' => $total_harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('admin/laporan-keuangan/bimbel')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $transaksi = DB::table('pesanan_bimbel')->where('id_pesanan_bimbel', $id)->first();

        return view('admin.laporan-keuangan.bimbel.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_pelanggan' => 'required',
                'jenis_bimbel' => 'required',
                'judul_projek' => 'required',
                'total_harga' => 'required|numeric|min:1',
            ],
            [
                'nama_pelanggan.required' => 'Nama pelanggan harus diisi.',
                'jenis_bimbel.required' => 'Jenis bimbel harus diisi.',
                'judul_projek.required' => 'Judul projek harus diisi.',
                'total_harga.required' => 'Total harga harus diisi.',
                'total_harga.numeric' => 'Total harga harus berupa angka.',
                'total_harga.min' => 'Total harga minimal 1.',
            ]
        );

        $total_harga = str_replace('.', '', $request->total_harga);
        DB::table('pesanan_bimbel')->where('id_pesanan_bimbel', $id)->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_bimbel' => $request->jenis_bimbel,
            'judul_projek' => $request->judul_projek,
            'total_harga' => $total_harga,
            'updated_at' => now(),
        ]);

        return redirect()->to('admin/laporan-keuangan/bimbel')->with('success', 'Data berhasil diubah');
    }

    public function hapus($id){
        DB::table('pesanan_bimbel')->where('id_pesanan_bimbel', $id)->delete();

        return redirect()->to('admin/laporan-keuangan/bimbel')->with('success', 'Data berhasil dihapus');
    }
}
