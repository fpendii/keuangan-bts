<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananJilid extends Model
{
    protected $table = 'pesanan_jilid';

    public $timestamps = false;

    protected $primaryKey = 'id_pesanan_jilid';

    protected $fillable = [
        'id_pelanggan',
        'id_layanan',
        'jumlah',
        'harga',
        'dokumen',
        'total_harga',
        'created_at',
        'updated_at'
    ];

}
