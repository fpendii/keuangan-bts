<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanBimbelController extends Controller
{
    public function bimbel(){
        return view('admin.laporan-keuangan.bimbel.index');
    }
}
