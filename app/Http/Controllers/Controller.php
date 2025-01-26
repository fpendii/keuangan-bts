<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Log;


abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function BaseStore($table, $id_name)
    {
        DB::beginTransaction();

        try {
            // Hitung pendapatan bulan ini
            $totalPendapatanBulanIni = DB::table($table)
                ->where('status_store', 'proses')
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->sum('total_harga');

            if ($totalPendapatanBulanIni == 0) {
                return ['status' => false, 'message' => 'Tidak ada transaksi untuk bulan ini'];
            }

            // Tambahkan ke total pusat uang
            $total_pusat_uang = DB::table('pusat_uang')
                ->where('id_pusat_uang', 1)
                ->select('total_uang')
                ->first();

            if (!$total_pusat_uang) {
                return ['status' => false, 'message' => 'Data pusat uang tidak ditemukan'];
            }

            $totalPendapatanBulanIni += $total_pusat_uang->total_uang;

            // Update atau insert pusat uang
            DB::table('pusat_uang')->updateOrInsert(
                ['id_pusat_uang' => 1],
                ['total_uang' => $totalPendapatanBulanIni, 'updated_at' => now()]
            );

            // Update status pesanan
            $pesanan = DB::table($table)
                ->where('status_store', 'proses')
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->get();

            if ($pesanan->isNotEmpty()) {
                $ids = $pesanan->pluck($id_name);
                DB::table($table)->whereIn($id_name, $ids)->update([
                    'status_store' => 'selesai',
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return ['status' => true, 'message' => 'Hasil Pendapatan Bulan Ini Berhasil Disimpan'];
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return ['status' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

}
