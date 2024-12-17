<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanServisController extends Controller
{
    public function servis()
    {
        return view('admin.laporan-keuangan.servis.index');
    }
}
