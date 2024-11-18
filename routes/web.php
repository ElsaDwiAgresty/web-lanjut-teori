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

//MENU
Route::get('menu', [AdminController::class, 'indexMenu'])
    ->name('admin.menu.index');
Route::get('menu/create', [AdminController::class, 'createMenu'])
    ->name('admin.menu.create');


// RESERVASI
Route::get('reservasi', [PelangganController::class, 'indexReservasi'])
    ->name('pelanggan.reservasi')
    ->middleware('loginCheck');
Route::get('reservasi/create', [PelangganController::class, 'reservasi'])
    ->name('pelanggan.reservasi.create');
Route::post('reservasi', [PelangganController::class, 'storeReservasi'])
    ->name('pelanggan.reservasi.store');

Route::get('/reservasi-saya', [PelangganController::class, 'reservasiSaya'])->name('reservasi.saya');


//REGISTRASI
Route::get('registrasi', [PelangganController::class, 'indexRegistrasi'])
    ->name('pelanggan.registrasi')
    ->middleware('loginCheck');
Route::get('registrasi/create', [PelangganController::class, 'registrasi'])
    ->name('pelanggan.registrasi.create');
Route::post('registrasi', [PelangganController::class, 'storeRegistrasi'])
    ->name('pelanggan.registrasi.store');


//LOGIN
Route::get('login', [PelangganController::class, 'indexLogin'])
    ->name('login')
    ->middleware('loginCheck');
Route::post('login', [PelangganController::class, 'login'])
    ->name('pelanggan.login');


//HOME
Route::get('/', [PelangganController::class, 'indexMenu'])
    ->name('home');
Route::get('/', [PelangganController::class, 'indexHome'])
    ->name('home');


//DASHBOARD
Route::get('dashboard', [PelangganController::class, 'dashboard'])
    ->name('pelanggan.dashboard')
    ->middleware('authCheck');


//LOGOUT
Route::get('logout', [PelangganController::class, 'logout'])
    ->name('pelanggan.logout');


//PROFIL
Route::put('/pelanggan/update', [PelangganController::class, 'updateProfil'])->name('pelanggan.profile');
Route::get('/pelanggan/profile', [PelangganController::class, 'profil'])
    ->name('pelanggan.profil')
    ->middleware('authCheck');
Route::put('/pelanggan/update', [PelangganController::class, 'updateProfil'])
    ->name('pelanggan.updateProfil')
    ->middleware('authCheck');
Route::get('/pelanggan/update', [PelangganController::class, 'updateProfil'])->name('pelanggan.profile');

Route::get('admin/menu', [AdminController::class, 'indexMenu'])->name('admin.menu.index');

