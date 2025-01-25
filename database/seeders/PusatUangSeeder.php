<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB; // Gunakan namespace yang benar
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PusatUangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data ke tabel transaksi
        DB::table('pusat_uang')->insert([
            [
                'id_pusat_uang' => 1,
                'nama_pusat_uang' => 'bimbel',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pusat_uang' => 2,
                'nama_pusat_uang' => 'jas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pusat_uang' => 3,
                'nama_pusat_uang' => 'jilid',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pusat_uang' => 4,
                'nama_pusat_uang' => 'printing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pusat_uang' => 5,
                'nama_pusat_uang' => 'servis',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
