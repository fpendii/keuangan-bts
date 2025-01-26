<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaAdminController extends Controller
{
    public function index()
    {
        $total_uang = DB::table('pusat_uang')->first();
        $total_uang = number_format($total_uang->total_uang, 0, ',', '.');
        return view('admin.beranda.index', compact('total_uang'));
    }
}
