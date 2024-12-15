<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanJasController extends Controller
{
    public function jas(){
        return view('admin.laporan-keuangan.jas.index');
    }
}
