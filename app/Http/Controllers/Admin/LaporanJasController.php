<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanJasController extends Controller
{
    public function jas(){
        $transaksi = DB::table('pesanan_jas')->get();

        return view('admin.laporan-keuangan.jas.index',compact('transaksi'));
    }

    public function tambah(){
        return view('admin.laporan-keuangan.jas.tambah');
    }

    public function simpan(Request $request){
        
        $request->validate(
            [
                'id_pesanan_jas' => 'required',
                'id_user' => 'required',
                'id_jas' => 'required',
                'jumlah' => 'required',
                'status' => 'required',
            ]
            );

        DB::table('pesanan_jas')->insert([
            'id_pesanan_jas' => $request->id_pesanan_jas,
            'id_user' => $request->id_user,
            'id_jas' => $request->id_jas,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('admin/laporan-keuangan/jas')->with('success', 'Data berhasil disimpan');
    }
}
