<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanJilidController extends Controller
{
    public function jilid()
    {
        return view('admin.laporan-keuangan.jilid.index');
    }
}
