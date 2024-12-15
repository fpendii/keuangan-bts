<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BerandaAdminController;

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
});


