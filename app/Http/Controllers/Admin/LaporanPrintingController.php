<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPrintingController extends Controller
{

    public function printing()
    {
        $transaksi = DB::table('pesanan_printing')->where('status_store', 'proses')->get();
        $totalPendapatanBulanIni = DB::table('pesanan_printing')
            ->where('status_store', 'proses')
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
            'dokumen.*' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $hargaPerlembar = $request->warna === 'Color' ? 500 : 400;

        if ($request->kertas === 'Ya') {
            $hargaPerlembar -= 100;
        }

        $totalHalaman = 0;
        $fileNames = '';

        if ($request->hasFile('dokumen')) {
            $no = 1;
            foreach ($request->file('dokumen') as $file) {
                $name = '[' . $no++ . '] ' . $file->getClientOriginalName();
                $fileNames .= $name . ', ';

                if ($file->getClientOriginalExtension() === 'pdf') {
                    $parser = new \Smalot\PdfParser\Parser();
                    $pdf = $parser->parseFile($file->getPathname());
                    $halaman = $pdf->getDetails()['Pages'] ?? 0;
                    $totalHalaman += $halaman;
                } else {
                    $totalHalaman++;
                }
            }
        }

        $fileNames = rtrim($fileNames, ', ');
        $totalHarga = $totalHalaman * $hargaPerlembar;

        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'warna' => $request->warna,
            'kertas' => $request->kertas,
            'jumlah' => $totalHalaman,
            'total_harga' => $totalHarga,
            'dokumen' => $fileNames,
        ];

        DB::table('pesanan_printing')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        // // Generate PDF
        // $pdf = Pdf::loadView('admin.laporan-keuangan.printing.invoice', $data);
        // $fileName = 'invoice_' . now()->format('Ymd_His') . '.pdf';

        // // Simpan PDF ke storage
        // $filePath = storage_path('app/public/invoices/' . $fileName);
        // $pdf->save($filePath);

        // // Simpan path ke session
        // session(['invoice_path' => $filePath]);

        // Redirect ke halaman sebelumnya
        return redirect()->to('admin/laporan-keuangan/printing')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $transaksi = DB::table('pesanan_printing')->where('id_pesanan_printing', $id)->first();
        $total_harga = number_format($transaksi->total_harga);

        return view('admin.laporan-keuangan.printing.edit', compact('transaksi', 'total_harga'));
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

    public function store()
    {
        $totalPendapatanBulanIni = DB::table('pesanan_printing')
            ->where('status_store', 'proses')
            ->whereMonth('created_at', date('m')) // Filter berdasarkan bulan
            ->whereYear('created_at', date('Y')) // Filter berdasarkan tahun
            ->sum('total_harga');
        if ($totalPendapatanBulanIni == 0) {
            return redirect()->to('admin/laporan-keuangan/printing')->with('error', 'Tidak ada transaksi untuk bulan ini');
        }

        $total_pusat_uang = DB::table('pusat_uang')->where('id_pusat_uang', 1)->select('total_uang')->first();

        $totalPendapatanBulanIni = $totalPendapatanBulanIni + $total_pusat_uang->total_uang;

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
