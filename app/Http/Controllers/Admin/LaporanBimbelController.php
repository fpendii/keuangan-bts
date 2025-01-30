<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanBimbelController extends Controller
{
    public function bimbel()
    {
        $transaksi = DB::table('pesanan_bimbel')->where('status_store','proses')->orderBy('created_at', 'desc')->get();
        $totalPendapatanBulanIni = DB::table('pesanan_bimbel')
            ->where('status_store', 'proses')
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

        $data = [
            'total_harga' => number_format($transaksi->total_harga, 0, ',', '.'),
        ];

        return view('admin.laporan-keuangan.bimbel.edit', compact('transaksi'),$data);
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

    public function store()
    {
        $totalPendapatanBulanIni = DB::table('pesanan_bimbel')
            ->where('status_store', 'proses')
            ->whereMonth('created_at', date('m')) // Filter berdasarkan bulan
            ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun
            ->sum('total_harga');

        if($totalPendapatanBulanIni == 0){
            return redirect()->to('admin/laporan-keuangan/bimbel')->with('error', 'Tidak ada transaksi untuk bulan ini');
        }

        $total_pusat_uang = DB::table('pusat_uang')->where('id_pusat_uang', 1)->select('total_uang')->first();

        $totalPendapatanBulanIni = $totalPendapatanBulanIni + $total_pusat_uang->total_uang;

        $pusat_uang_exists = DB::table('pusat_uang')->where('id_pusat_uang', 1)->exists();
        $pesanan_bimbel = DB::table('pesanan_bimbel')
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

            if ($pesanan_bimbel->isNotEmpty()) {
                $ids = $pesanan_bimbel->pluck('id_pesanan_bimbel');
                DB::table('pesanan_bimbel')->whereIn('id_pesanan_bimbel', $ids)->update([
                    'status_store' => 'selesai',
                    'updated_at' => now(),
                ]);
            }
            DB::commit();

            return redirect()->to('admin/laporan-keuangan/bimbel')->with('success', 'Hasil Pendatapan Bulan Ini Berhasil Disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
