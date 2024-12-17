<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data ke tabel divisi
        DB::table('divisi')->insert([
            [
                'nama_divisi' => 'Printing',
            ],
            [
                'nama_divisi' => 'Jilid',
            ],
            [
                'nama_divisi' => 'Bimbel',
            ],
            [
                'nama_divisi' => 'Jas',
            ],
            [
                'nama_divisi' => 'Servis',
            ],
        ]);
    }
}
