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

Route::get('menu', [AdminController::class, 'indexMenu'])
    ->name('admin.menu.index');
Route::get('menu/create', [AdminController::class, 'createMenu'])
    ->name('admin.menu.create');


// Rute untuk melihat dan membuat reservasi
Route::get('reservasi', [PelangganController::class, 'indexReservasi'])
    ->name('pelanggan.reservasi')
    ->middleware('loginCheck');
Route::get('reservasi/create', [PelangganController::class, 'reservasi'])
    ->name('pelanggan.reservasi.create');
Route::post('reservasi', [PelangganController::class, 'store'])
    ->name('pelanggan.reservasi.store');

Route::get('registrasi', [PelangganController::class, 'indexRegistrasi'])
    ->name('pelanggan.registrasi')
    ->middleware('loginCheck');
Route::get('registrasi/create', [PelangganController::class, 'registrasi'])
    ->name('pelanggan.registrasi.create');
Route::post('registrasi', [PelangganController::class, 'storeRegistrasi'])
    ->name('pelanggan.registrasi.store');

Route::get('login', [PelangganController::class, 'indexLogin'])
    ->name('login')
    ->middleware('loginCheck');
Route::post('login', [PelangganController::class, 'login'])
    ->name('pelanggan.login');

Route::get('/', [PelangganController::class, 'indexMenu'])
    ->name('home');
Route::get('/', [PelangganController::class, 'indexHome'])
    ->name('home');

Route::get('dashboard', [PelangganController::class, 'dashboard'])
    ->name('pelanggan.dashboard')
    ->middleware('authCheck');

Route::get('logout', [PelangganController::class, 'logout'])
    ->name('pelanggan.logout');