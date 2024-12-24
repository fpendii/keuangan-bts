<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananJas extends Model
{
    protected $table = 'pesanan_jas';
    protected $primaryKey = 'id_pesanan_jas';
    protected $fillable = ['id_pelanggan', 'id_layanan', 'ukuran_jas', 'jumlah', 'total_harga', 'created_at', 'updated_at'];
}
