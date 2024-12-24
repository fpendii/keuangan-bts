<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananBimbel extends Model
{
    protected $table = 'pesanan_bimbel';
    protected $guarded = [];
    public $timestamps = false;

    protected $primaryKey = 'id_pesanan_bimbel';

    protected $fillable = [
        'id_pelanggan',
        'id_layanan',
        'jenis_bimbel',
        'judul_projek',
        'total_harga',
        'created_at',
        'updated_at'
    ];
}
