<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPrintingController extends Controller
{
    protected $id_divisi = 1;
    public function printing()
    {
        $transaksi = DB::table('pesanan_printing')->get();
        $totalPendapatanBulanIni = DB::table('pesanan_printing')
            ->whereMonth('created_at', date('m')) // Filter berdasarkan bulan
            ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun
            ->sum('total_harga');


        return view('admin.laporan-keuangan.printing.index', compact('transaksi', 'totalPendapatanBulanIni'));
    }

    public function tambah()
    {
        return view('admin.laporan-keuangan.printing.tambah');
    }


    public function simpan(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'warna' => 'required',
            'kertas' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'total_harga' => 'required|numeric|min:1',
            'dokumen' => 'required_if:mode,pengeluaran|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ], [
            'dokumen.required_if' => 'Dokumen harus diunggah untuk transaksi pengeluaran.',
            'dokumen.file' => 'Dokumen harus berupa file.',
            'dokumen.mimes' => 'Format dokumen yang diperbolehkan: PDF, Word, Excel, PowerPoint.',
            'total_harga.required' => 'Total harga harus diisi.',
            'total_harga.numeric' => 'Total harga harus berupa angka.',
            'total_harga.min' => 'Total harga minimal 1.',
            'jumlah.required' => 'Jumlah lembar harus diisi.',
            'jumlah.numeric' => 'Jumlah lembar harus berupa angka.',
            'jumlah.min' => 'Jumlah lembar minimal 1.',
            'warna.required' => 'Warna harus diisi.',
            'kertas.required' => 'Kertas harus diisi.',
            'nama_pelanggan.required' => 'Nama pelanggan harus diisi.',
        ]);

        $total_harga = str_replace('.', '', $request->total_harga);

        DB::table('pesanan_printing')->insert([
            'nama_pelanggan' => $request->nama_pelanggan,
            'warna' => $request->warna,
            'kertas' => $request->kertas,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'dokumen' => $request->file('dokumen')->getClientOriginalName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('admin/laporan-keuangan/printing')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function edit($id)
    {
        $transaksi = DB::table('pesanan_printing')->where('id_pesanan_printing', $id)->first();

        return view('admin.laporan-keuangan.printing.edit', compact('transaksi'));
    }

    public function update(TransaksiRequest $request, $id)
    {

        if (!$request->file('nama_dokument')) {
            $nama_dokument = $request->nama_dokument_lama;
        } else {
            $nama_dokument = $request->file('nama_dokument')->getClientOriginalName();
        }

        $total_harga = str_replace('.', '', $request->total_harga);

        DB::table('pesanan_printing')->where('id_pesanan_printing', $id)->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jumlah' => $request->jumlah,
            'dokumen' => $nama_dokument,
            'warna' => $request->warna,
            'kertas' => $request->kertas,
            'total_harga' => $total_harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('admin/laporan-keuangan/printing')->with('success', 'Data berhasil diupdate');
    }

    public function hapus($id)
    {
        DB::table('pesanan_printing')->where('id_pesanan_printing', $id)->delete();

        return redirect()->to('admin/laporan-keuangan/printing')->with('success', 'Data berhasil dihapus');
    }
}
