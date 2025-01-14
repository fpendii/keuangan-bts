<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanJilidController extends Controller
{

    public function jilid()
    {
        $transaksi = DB::table('pesanan_jilid')->get();
        $totalPendapatanBulanIni = DB::table('pesanan_jilid')
            ->whereMonth('created_at', date('m')) // Filter berdasarkan bulan
            ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun
            ->sum('total_harga');

        return view('admin.laporan-keuangan.jilid.index', compact('transaksi', 'totalPendapatanBulanIni'));
    }

    public function tambah()
    {
        return view('admin.laporan-keuangan.jilid.tambah');
    }

    public function edit($id){
        $transaksi = DB::table('pesanan_jilid')->where('id_pesanan_jilid', $id)->first();

        return view('admin.laporan-keuangan.jilid.edit', compact('transaksi'));
    }

    public function hapus($id){
        DB::table('pesanan_jilid')->where('id_pesanan_jilid', $id)->delete();

        return redirect()->to('admin/laporan-keuangan/jilid')->with('success', 'Data berhasil dihapus');
    }

    public function simpan(Request $request){
        $request->validate([
            'nama_pelanggan' => 'required',
            'jenis_jilid' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'total_harga' => 'required|numeric|min:1',
            'nama_dokument' => 'required_if:mode,pengeluaran|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ], [
            'nama_dokumen.required_if' => 'Dokumen harus diisi jika mode adalah pengeluaran',
            'nama_dokumen.mimes' => 'Dokumen harus berupa file PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX',
        ]);

        $total_harga = str_replace('.', '', $request->total_harga);

        DB::table('pesanan_jilid')->insert([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_jilid' => $request->jenis_jilid,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'dokumen' =>  $request->file('nama_dokument')->getClientOriginalName(),
        ]);

        return redirect()->to('admin/laporan-keuangan/jilid')->with('success', 'Data berhasil disimpan');
    }

}
