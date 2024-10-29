<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PelangganController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('create', function(){
    return view('create');
});

Route::get('menu', [AdminController::class, 'indexMenu'])->name('admin.menu.index');
Route::get('menu/create', [AdminController::class, 'createMenu'])->name('admin.menu.create');


// Rute untuk melihat dan membuat reservasi
Route::get('reservasi', [PelangganController::class, 'indexReservasi'])->name('pelanggan.reservasi');
Route::get('reservasi/create', [PelangganController::class, 'reservasi'])->name('pelanggan.reservasi.create');
Route::post('reservasi', [PelangganController::class, 'storeReservasi'])->name('pelanggan.reservasi.store');

Route::get('registrasi', [PelangganController::class, 'indexRegistrasi'])->name('pelanggan.registrasi');