<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data ke tabel transaksi
        DB::table('transaksi')->insert([
            [
                'id_divisi' => 1, // Divisi Printing
                'jenis_transaksi' => 'Pemasukan',
                'jumlah' => 100000,
                'keterangan' => 'Pemasukan dari hasil order printing.',
                'tanggal_transaksi' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_divisi' => 2, // Divisi Jilid
                'jenis_transaksi' => 'Pengeluaran',
                'jumlah' => 200000,
                'keterangan' => 'Pengeluaran untuk bahan jilid.',
                'tanggal_transaksi' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_divisi' => 3, // Divisi Bimbel
                'jenis_transaksi' => 'Pemasukan',
                'jumlah' => 500000,
                'keterangan' => 'Pemasukan dari biaya bimbingan.',
                'tanggal_transaksi' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_divisi' => 4, // Divisi Jas
                'jenis_transaksi' => 'Pengeluaran',
                'jumlah' => 150000,
                'keterangan' => 'Pengeluaran untuk bahan jas.',
                'tanggal_transaksi' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_divisi' => 5, // Divisi Servis
                'jenis_transaksi' => 'Pemasukan',
                'jumlah' => 300000,
                'keterangan' => 'Pemasukan dari servis peralatan.',
                'tanggal_transaksi' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
