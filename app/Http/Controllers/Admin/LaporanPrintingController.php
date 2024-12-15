<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanPrintingController extends Controller
{
    public function printing()
    {
        return view('admin.laporan-keuangan.printing.index');
    }
}
