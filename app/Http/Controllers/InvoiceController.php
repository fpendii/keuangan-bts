<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function downloadInvoice()
    {
        $filePath = session('invoice_path');

        if ($filePath && file_exists($filePath)) {
            session()->forget('invoice_path');
            return response()->download($filePath)->deleteFileAfterSend();
        }

        abort(404, 'File tidak ditemukan.');
    }

    public function downloadInvoicePrinting($id)
    {
        $dataPesanan = DB::table('pesanan_printing')->where('id_pesanan_printing', $id)->first();

        if (!$dataPesanan) {
            return redirect()->back()->with('error', 'Data pesanan tidak ditemukan.');
        }

        $data = [
            'nama_pelanggan' => $dataPesanan->nama_pelanggan,
            'warna' => $dataPesanan->warna,
            'kertas' => $dataPesanan->kertas,
            'jumlah' => $dataPesanan->jumlah,
            'total_harga' => $dataPesanan->total_harga,
            'dokumen' => $dataPesanan->dokumen,
        ];

        // Generate PDF tanpa menyimpan ke file
        $pdf = Pdf::loadView('admin.laporan-keuangan.printing.invoice', $data);

        // Mengembalikan response untuk mendownload langsung tanpa menyimpan
        return $pdf->download('invoice_' . now()->format('Ymd_His') . '.pdf');
    }

    public function downloadInvoiceJilid($id)
    {
        $dataPesanan = DB::table('pesanan_jilid')->where('id_pesanan_jilid', $id)->first();

        if (!$dataPesanan) {
            return redirect()->back()->with('error', 'Data pesanan tidak ditemukan.');
        }

        $data = [
            'nama_pelanggan' => $dataPesanan->nama_pelanggan,
            'jenis_jilid' => $dataPesanan->jenis_jilid,
            'jumlah' => $dataPesanan->jumlah,
            'total_harga' => $dataPesanan->total_harga,
            'dokumen' => $dataPesanan->dokumen,
            'created_at' => $dataPesanan->created_at,
        ];

        // Generate PDF tanpa menyimpan ke file
        $pdf = Pdf::loadView('admin.laporan-keuangan.jilid.invoice', $data);

        // Mengembalikan response untuk mendownload langsung tanpa menyimpan
        return $pdf->download('invoice_' . now()->format('Ymd_His') . '.pdf');
    }

    public function downloadInvoiceBimbel($id)
    {
        $dataPesanan = DB::table('pesanan_bimbel')->where('id_pesanan_bimbel', $id)->first();

        if (!$dataPesanan) {
            return redirect()->back()->with('error', 'Data pesanan tidak ditemukan.');
        }

        $data = [
            'nama_pelanggan' => $dataPesanan->nama_pelanggan,
            'jenis_bimbel' => $dataPesanan->jenis_bimbel,
            'judul_projek' => $dataPesanan->judul_projek,
            'total_harga' => $dataPesanan->total_harga,
            'created_at' => $dataPesanan->created_at,
        ];

        // Generate PDF tanpa menyimpan ke file
        $pdf = Pdf::loadView('admin.laporan-keuangan.bimbel.invoice', $data);

        // Mengembalikan response untuk mendownload langsung tanpa menyimpan
        return $pdf->download('invoice_' . now()->format('Ymd_His') . '.pdf');
    }

    public function downloadInvoiceJas($id) {
        $dataPesanan = DB::table('pesanan_jas')->where('id_pesanan_jas', $id)->first();

        if (!$dataPesanan) {
            return redirect()->back()->with('error', 'Data pesanan tidak ditemukan.');
        }

        $data = [
            'nama_pelanggan' => $dataPesanan->nama_pelanggan,
            'ukuran_jas' => $dataPesanan->ukuran_jas,
            'jumlah' => $dataPesanan->jumlah,
            'total_harga' => $dataPesanan->total_harga,
            'created_at' => $dataPesanan->created_at,
        ];

        // Generate PDF tanpa menyimpan ke file
        $pdf = Pdf::loadView('admin.laporan-keuangan.jas.invoice', $data);

        // Mengembalikan response untuk mendownload langsung tanpa menyimpan
        return $pdf->download('invoice_' . now()->format('Ymd_His') . '.pdf');
    }

    public function downloadInvoiceServis($id) {
        $dataPesanan = DB::table('pesanan_servis')->where('id_pesanan_servis', $id)->first();

        if (!$dataPesanan) {
            return redirect()->back()->with('error', 'Data pesanan tidak ditemukan.');
        }

        $data = [
            'nama_pelanggan' => $dataPesanan->nama_pelanggan,
            'unit_servis' => $dataPesanan->unit_servis,
            'kelengkapan' => $dataPesanan->kelengkapan,
            'jenis_servis' => $dataPesanan->jenis_servis,
            'total_harga' => $dataPesanan->total_harga,
            'created_at' => $dataPesanan->created_at,
        ];
        // Generate PDF tanpa menyimpan ke file
        $pdf = Pdf::loadView('admin.laporan-keuangan.servis.invoice', $data);

        // Mengembalikan response untuk mendownload langsung tanpa menyimpan
        return $pdf->download('invoice_' . now()->format('Ymd_His') . '.pdf');
    }
}
