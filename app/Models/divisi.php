<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
    protected $table = 'divisi';

    protected $primaryKey = 'id_divisi';

    public $timestamps = false;

    protected $fillable = [
        'nama_divisi',
    ];


}
