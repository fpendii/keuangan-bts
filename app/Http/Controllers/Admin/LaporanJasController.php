<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanJasController extends Controller
{
    protected $table = 'pesanan_jas';
    protected $id_name = 'id_pesanan_jas';
    protected $redirect = 'admin/laporan-keuangan/jas';

    public function jas()
    {
        $transaksi = DB::table('pesanan_jas')->where('status_store', 'proses')->get();
        $totalPendapatanBulanIni = DB::table('pesanan_jas')
            ->where('status_store', 'proses')
            ->whereMonth('created_at', date('m')) // Filter berdasarkan bulan
            ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun
            ->sum('total_harga');

        return view('admin.laporan-keuangan.jas.index', compact('transaksi', 'totalPendapatanBulanIni'));
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

    public function edit($id)
    {
        $transaksi = DB::table('pesanan_jas')->where('id_pesanan_jas', $id)->first();

        $data = [
            'total_harga' => number_format($transaksi->total_harga, 0, ',', '.'),
        ];

        return view('admin.laporan-keuangan.jas.edit', compact('transaksi'), $data);
    }

    public function update(Request $request, $id)
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

        DB::table('pesanan_jas')->where('id_pesanan_jas', $id)->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'ukuran_jas' => $request->ukuran_jas,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
            'updated_at' => now(),
        ]);

        return redirect()->to('admin/laporan-keuangan/jas')->with('success', 'Data berhasil diubah');
    }

    public function hapus($id)
    {
        DB::table('pesanan_jas')->where('id_pesanan_jas', $id)->delete();

        return redirect()->to('admin/laporan-keuangan/jas')->with('success', 'Data berhasil dihapus');
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
