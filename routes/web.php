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
        Route::post('/order/printing/simpan', 'simpan')->name('printing.simpan');
        Route::get('/order/printing/edit/{id}', 'edit')->name('printing.edit');
        Route::put('/order/printing/update/{id}', 'update')->name('printing.update');
        Route::delete('/order/printing/hapus/{id}', 'hapus')->name('printing.hapus');
        Route::post('/order/printing/store', 'store')->name('printing.store');
    });

    Route::controller(LaporanJilidController::class)->group(function () {
        Route::get('/laporan-keuangan/jilid', 'jilid')->name('laporan-keuangan.jilid');
        Route::get('/order/jilid/tambah', 'tambah')->name('jilid.tambah');
        Route::post('/order/jilid/simpan', 'simpan')->name('jilid.simpan');
        Route::get('/order/jilid/edit/{id}', 'edit')->name('jilid.edit');
        Route::put('/order/jilid/update/{id}', 'update')->name('jilid.update');
        Route::delete('/order/jilid/hapus/{id}', 'hapus')->name('jilid.hapus');
    });

    Route::controller(LaporanBimbelController::class)->group(function () {
        Route::get('/laporan-keuangan/bimbel', 'bimbel')->name('laporan-keuangan.bimbel');
        Route::get('/order/bimbel/tambah', 'tambah')->name('bimbel.tambah');
        Route::post('/order/bimbel/simpan', 'simpan')->name('bimbel.simpan');
        Route::get('/order/bimbel/edit/{id}', 'edit')->name('bimbel.edit');
        Route::put('/order/bimbel/update/{id}', 'update')->name('bimbel.update');
        Route::delete('/order/bimbel/hapus/{id}', 'hapus')->name('bimbel.hapus');
    });

    Route::controller(LaporanJasController::class)->group(function () {
        Route::get('/laporan-keuangan/jas', 'jas')->name('laporan-keuangan.jas');
        Route::get('/order/jas/tambah', 'tambah')->name('jas.tambah');
        Route::post('/order/jas/simpan', 'simpan')->name('jas.simpan');
        Route::get('/order/jas/edit/{id}', 'edit')->name('jas.edit');
        Route::put('/order/jas/update/{id}', 'update')->name('jas.update');
        Route::delete('/order/jas/hapus/{id}', 'hapus')->name('jas.hapus');
    });

    Route::controller(LaporanServisController::class)->group(function () {
        Route::get('/laporan-keuangan/servis', 'servis')->name('laporan-keuangan.servis');
        Route::get('/order/servis/tambah', 'tambah')->name('servis.tambah');
        Route::post('/order/servis/simpan', 'simpan')->name('servis.simpan');
        Route::get('/order/servis/edit/{id}', 'edit')->name('servis.edit');
        Route::put('/order/servis/update/{id}', 'update')->name('servis.update');
        Route::delete('/order/servis/hapus/{id}', 'hapus')->name('servis.hapus');
    });
});


