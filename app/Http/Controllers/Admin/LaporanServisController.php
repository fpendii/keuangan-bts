<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanServisController extends Controller
{
    protected $table = 'pesanan_servis';
    protected $id_name = 'id_pesanan_servis';
    protected $redirect = 'admin/laporan-keuangan/servis';
    public function servis()
    {
        $transaksi = DB::table('pesanan_servis')->where('status_store', 'proses')->get();
        $totalPendapatanBulanIni = DB::table('pesanan_servis')
            ->where('status_store', 'proses')
            ->whereMonth('created_at', date('m')) // Filter berdasarkan bulan
            ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun
            ->sum('laba');

        return view('admin.laporan-keuangan.servis.index',compact('transaksi', 'totalPendapatanBulanIni'));
    }

    public function tambah(){
        return view('admin.laporan-keuangan.servis.tambah');
    }

    public function simpan(Request $request){
        $request->validate(
            [
                'nama_pelanggan' => 'required',
                'jenis_servis' => 'required',
                'unit_servis' => 'required',
                'kelengkapan' => 'required',
                'harga_modal' => 'required',
                'harga_jual' => 'required',
                'laba' => 'required',
            ],
            [
                'nama_pelanggan.required' => 'Nama pelanggan harus diisi.',
                'jenis_servis.required' => 'Jenis servis harus diisi.',
                'unit_servis.required' => 'Unit servis harus diisi.',
                'kelengkapan.required' => 'Kelengkapan harus diisi.',
                'harga_modal.required' => 'Harga modal harus diisi.',
                'harga_jual.required' => 'Harga jual harus diisi.',
                'laba.required' => 'Laba harus diisi.',
            ]
        );

        $harga_modal = str_replace('.', '', $request->harga_modal);
        $harga_jual = str_replace('.', '', $request->harga_jual);
        $laba = str_replace('.', '', $request->laba);

        DB::table('pesanan_servis')->insert([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_servis' => $request->jenis_servis,
            'unit_servis' => $request->unit_servis,
            'kelengkapan' => $request->kelengkapan,
            'harga_modal' => $harga_modal,
            'harga_jual' => $harga_jual,
            'total_harga' => $laba,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/laporan-keuangan/servis')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id){
        $transaksi = DB::table('pesanan_servis')->where('id_pesanan_servis', $id)->first();
        $data = [
            'harga_modal' => number_format($transaksi->harga_modal, 0, ',', '.'),
            'harga_jual' => number_format($transaksi->harga_jual, 0, ',', '.'),
            'laba' => number_format($transaksi->total_harga, 0, ',', '.'),
        ];

        return view('admin.laporan-keuangan.servis.edit', compact('transaksi'), $data);
    }

    public function update(Request $request, $id){
        $request->validate(
            [
                'nama_pelanggan' => 'required',
                'jenis_servis' => 'required',
                'unit_servis' => 'required',
                'kelengkapan' => 'required',
                'harga_modal' => 'required',
                'harga_jual' => 'required',
                'laba' => 'required',
            ],
            [
                'nama_pelanggan.required' => 'Nama pelanggan harus diisi.',
                'jenis_servis.required' => 'Jenis servis harus diisi.',
                'unit_servis.required' => 'Unit servis harus diisi.',
                'kelengkapan.required' => 'Kelengkapan harus diisi.',
                'harga_modal.required' => 'Harga modal harus diisi.',
                'harga_jual.required' => 'Harga jual harus diisi.',
                'laba.required' => 'Laba harus diisi.',
            ]
        );

        $harga_modal = str_replace('.', '', $request->harga_modal);
        $harga_jual = str_replace('.', '', $request->harga_jual);
        $laba = str_replace('.', '', $request->laba);

        DB::table('pesanan_servis')->where('id_pesanan_servis', $id)->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'jenis_servis' => $request->jenis_servis,
            'unit_servis' => $request->unit_servis,
            'kelengkapan' => $request->kelengkapan,
            'harga_modal' => $harga_modal,
            'harga_jual' => $harga_jual,
            'total_harga' => $laba,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/laporan-keuangan/servis')->with('success', 'Data berhasil diubah.');
    }

    public function hapus($id){
        DB::table('pesanan_servis')->where('id_pesanan_servis', $id)->delete();
        return redirect('/admin/laporan-keuangan/servis')->with('success', 'Data berhasil dihapus.');
    }

    public function store()
    {
        $result = $this->BaseStore($this->table, $this->id_name);

        if ($result['status']) {
            return redirect()->to($this->redirect)->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }
}
