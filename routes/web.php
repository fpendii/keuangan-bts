<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BerandaAdminController;
use App\Http\Controllers\Admin\LaporanPrintingController;
use App\Http\Controllers\Admin\LaporanJilidController;
use App\Http\Controllers\Admin\LaporanBimbelController;
use App\Http\Controllers\Admin\LaporanJasController;
use App\Http\Controllers\Admin\LaporanServisController;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('/sign-in', 'signin')->name('signin');
    Route::get('/sign-up', 'signup')->name('signup');
});

Route::prefix('admin')->group(function () {
    Route::controller(BerandaAdminController::class)->group(function () {
        Route::get('/beranda', 'index')->name('beranda');
    });


    Route::controller(LaporanPrintingController::class)->group(function () {
        Route::get('/laporan-keuangan/printing', 'printing')->name('laporan-keuangan.printing');
        Route::get('/order/printing/tambah', 'tambah')->name('printing.tambah');
    });

    Route::controller(LaporanJilidController::class)->group(function () {
        Route::get('/laporan-keuangan/jilid', 'jilid')->name('laporan-keuangan.jilid');
    });

    Route::controller(LaporanBimbelController::class)->group(function () {
        Route::get('/laporan-keuangan/bimbel', 'bimbel')->name('laporan-keuangan.bimbel');
    });

    Route::controller(LaporanJasController::class)->group(function () {
        Route::get('/laporan-keuangan/jas', 'jas')->name('laporan-keuangan.jas');
    });

    Route::controller(LaporanServisController::class)->group(function () {
        Route::get('/laporan-keuangan/servis', 'servis')->name('laporan-keuangan.servis');
    });
});


