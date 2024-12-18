<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{

    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_divisi',
        'jenis_transaksi',
        'jumlah',
        'keterangan',
        'tanggal_transaksi',
    ];


}
