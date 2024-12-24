<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananPrinting extends Model
{
    protected $table = 'pesanan_printing';
    protected $primaryKey = 'id_pesanan_printing';

    protected $fillable = [
        'id_pelanggan',
        'id_layanan',
        'warna',
        'jumlah',
        'dokumen',
        'total_harga',
        'created_at',
        'updated_at'
    ];
}
