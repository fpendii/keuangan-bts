<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanServisController extends Controller
{
    public function servis()
    {
        $transaksi = DB::table('pesanan_servis')->get();

        return view('admin.laporan-keuangan.servis.index',compact('transaksi'));
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
            'laba' => $laba,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin/laporan-keuangan/servis')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id){
        $transaksi = DB::table('pesanan_servis')->where('id_pesanan_servis', $id)->first();

        return view('admin.laporan-keuangan.servis.edit', compact('transaksi'));
    }
}
