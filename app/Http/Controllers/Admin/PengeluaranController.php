<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function pengeluaran(){
        return view('admin.pengeluaran.pengeluaran');
    }
}
