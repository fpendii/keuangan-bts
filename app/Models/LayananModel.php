<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananModel extends Model
{
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    public $timestamps = false;

    protected $fillable = [
        'id_layanan',
        'nama_layanan',
        'created_at',
        'updated_at',
    ];
}
