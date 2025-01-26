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

        $data = [
            'total_harga' => number_format($transaksi->total_harga, 0, ',', '.'),
        ];


        return view('admin.laporan-keuangan.jilid.edit', compact('transaksi'),$data);
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
            'nama_dokumen.required_if' => 'Dokumen harus diisi',
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

    public function update(Request $request, $id){

        if (!$request->file('nama_dokument')) {
            $nama_dokument = $request->nama_dokument_lama;
        } else {
            $nama_dokument = $request->file('nama_dokument')->getClientOriginalName();
        }

        $request->validate([
            'nama_pelanggan' => 'required',
            'jenis_jilid' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'total_harga' => 'required|numeric|min:1',
            'nama_dokument' => 'required_if:mode,pengeluaran|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
        ], [
            'nama_dokumen.required' => 'Dokumen harus diisi',
            'nama_dokumen.mimes' => 'Dokumen harus berupa file PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX',
        ]);

        $total_harga = str_replace('.', '', $request->total_harga);

        DB::table('pesanan_jilid')->where('id_pesanan_jilid', $id)->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_jilid' => $request->jenis_jilid,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'dokumen' =>  $nama_dokument,
        ]);

        return redirect()->to('admin/laporan-keuangan/jilid')->with('success', 'Data berhasil diupdate');
    }

    public function store(){
        $totalPendapatanBulanIni = DB::table('pesanan_jilid')
            ->whereMonth('created_at', date('m')) // Filter berdasarkan bulan
            ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun
            ->sum('total_harga');
        dd($totalPendapatanBulanIni);

        $pusat_uang_exists = DB::table('pusat_uang')->where('id_pusat_uang', 1)->exists();
        $pesanan_printing = DB::table('pesanan_printing')
            ->where('status_store', 'proses')
            ->whereMonth('created_at', date('m')) // Filter berdasarkan bulan
            ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun
            ->get();

        DB::beginTransaction();

        try {
            if (!$pusat_uang_exists) {
                DB::table('pusat_uang')->insert([
                    'total_uang' => $totalPendapatanBulanIni,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('pusat_uang')->where('id_pusat_uang', 1)->update([
                    'total_uang' => $totalPendapatanBulanIni,
                    'updated_at' => now(),
                ]);
            }

            if ($pesanan_printing->isNotEmpty()) {
                $ids = $pesanan_printing->pluck('id_pesanan_printing');
                DB::table('pesanan_printing')->whereIn('id_pesanan_printing', $ids)->update([
                    'status_store' => 'selesai',
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return redirect()->to('admin/laporan-keuangan/printing')->with('success', 'Hasil Pendatapan Bulan Ini Berhasil Disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
