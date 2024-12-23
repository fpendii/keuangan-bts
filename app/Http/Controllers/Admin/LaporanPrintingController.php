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
        $transaksi_masuk = DB::table('transaksi')->where('jenis_transaksi', 'Pemasukan')->where('id_divisi', $this->id_divisi)->get();
        $transaksi_keluar = DB::table('transaksi')->where('jenis_transaksi', 'Pengeluaran')->where('id_divisi', $this->id_divisi)->get();

        $total_pemasukan = $transaksi_masuk->sum('jumlah') - $transaksi_keluar->sum('jumlah');


        return view('admin.laporan-keuangan.printing.index', compact('transaksi_masuk', 'transaksi_keluar', 'total_pemasukan'));
    }

    public function tambah()
    {
        return view('admin.laporan-keuangan.printing.tambah');
    }


    public function simpan(Request $request)
    {
        $request->validate([
            'total_harga' => 'required|numeric',
            'mode' => 'required|in:order,pengeluaran',
            'nama_pelanggan' => 'required_if:mode,order',
            'nama_dokument' => 'required_if:mode,order|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
            'deskripsi_pengeluaran' => 'required_if:mode,pengeluaran'
        ]);

        // Proses data berdasarkan mode
        if ($request->mode === 'order') {
            // Proses untuk Tambah Order
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

            return redirect()->to('admin/laporan-keuangan/printing')
                ->with('success', 'Order berhasil disimpan');
        } else {
            // Proses untuk Tambah Pengeluaran
            $total_harga = str_replace('.', '', $request->total_harga);

            DB::table('transaksi')->insert([
                'id_divisi' => $this->id_divisi,
                'nama' => 'Pengeluaran',
                'jenis_transaksi' => 'Pengeluaran',
                'jumlah' => $total_harga,
                'keterangan' => $request->deskripsi_pengeluaran,
                'tanggal_transaksi' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->to('admin/laporan-keuangan/printing')
                ->with('success', 'Pengeluaran berhasil disimpan');
        }
    }

    public function edit($id)
    {
        $transaksi = DB::table('transaksi')->where('id_transaksi', $id)->first();

        return view('admin.laporan-keuangan.printing.edit', compact('transaksi'));
    }

    public function update(TransaksiRequest $request, $id)
    {

        $total_harga = str_replace('.', '', $request->jumlah);

        if (!$request->file('nama_dokument')) {
            $nama_dokument = $request->nama_dokument_lama;
        } else {
            $nama_dokument = $request->file('nama_dokument')->getClientOriginalName();
        }


        DB::table('transaksi')->where('id_transaksi', $id)->update([
            'id_divisi' => $this->id_divisi,
            'nama' => $request->nama_pelanggan,
            'jenis_transaksi' => 'Pemasukan',
            'jumlah' => $total_harga,
            'keterangan' => $nama_dokument,
            'tanggal_transaksi' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('admin/laporan-keuangan/printing')->with('success', 'Data berhasil diupdate');
    }

    public function hapus($id)
    {
        $transaksi = DB::table('transaksi')->where('id_transaksi', $id)->delete();

        return redirect()->to('admin/laporan-keuangan/printing')->with('success', 'Data berhasil dihapus');
    }
}
