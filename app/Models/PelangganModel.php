<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    public $timestamps = false;
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'id_pelanggan',
        'nama',
        'created_at',
        'updated_at'
    ];
}
