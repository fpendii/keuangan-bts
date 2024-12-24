<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananServis extends Model
{
    protected $table = 'pesanan_servis';
    protected $primaryKey = 'id_pesanan_servis';
    protected $fillable = ['id_pelanggan', 'id_layanan', 'jenis_servis', 'harga_modal', 'harga_jual', 'laba', 'created_at', 'updated_at'];
}
