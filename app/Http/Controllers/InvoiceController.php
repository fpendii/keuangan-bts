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
}
