<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

//MENU
Route::get('menu', [AdminController::class, 'indexMenu'])
    ->name('admin.menu.index');
Route::get('menu/create', [AdminController::class, 'createMenu'])
    ->name('admin.menu.create');

//PELANGGAN
Route::get('pelanggan', [AdminController::class, 'indexPelanggan'])
    ->name('admin.pelanggan.index');
Route::get('/pelanggan/edit/{id}', [AdminController::class, 'editPelanggan'])
    ->name('admin.pelanggan.editPelanggan');
Route::put('/pelanggan/update/{id}', [AdminController::class, 'updatePelanggan'])
    ->name('admin.pelanggan.updatePelanggan');
Route::delete('/pelanggan/{id}', [AdminController::class, 'destroyPelanggan'])
    ->name('admin.pelanggan.destroy');

// RESERVASI
Route::middleware('pelangganAuthCheck')->group(function() {
    Route::get('reservasi/create', [PelangganController::class, 'indexReservasi'])
        ->name('pelanggan.reservasi.create');
    Route::post('reservasi', [PelangganController::class, 'storeReservasi'])
        ->name('pelanggan.reservasi.store');
    Route::get('reservasi-saya', [PelangganController::class, 'reservasiSaya'])
        ->name('reservasi.saya');
});

//RESERVASI ADMIN
Route::get('reservasi', [AdminController::class, 'indexReservasi'])
    ->name('admin.reservasi');
Route::post('/reservasi/{id}/update-status', [AdminController::class, 'updateStatusReservasi'])
    ->name('admin.reservasi.updateStatus');

//LOGIN, REGISTRASI, DAN LOGOUT
Route::middleware('loginCheck')->group(function() {
    //LOGIN
    Route::get('login', [LoginController::class, 'indexLogin'])
        ->name('login');
    Route::post('login', [LoginController::class, 'login'])
        ->name('pelanggan.login');
    //REGISTRASI
    Route::get('registrasi', [LoginController::class, 'indexRegistrasi'])
        ->name('pelanggan.registrasi');
    Route::post('registrasi', [LoginController::class, 'storeRegistrasi'])
        ->name('pelanggan.registrasi.store');
    //LOGOUT
    Route::get('logout', [LoginController::class, 'logout'])
        ->name('pelanggan.logout');
});

//HOME
Route::get('/', [PelangganController::class, 'indexMenu'])
    ->name('home');
Route::get('/', [PelangganController::class, 'indexHome'])
    ->name('home');

//DASHBOARD PELANGGAN
Route::middleware('pelangganAuthCheck')->group(function() {
    //DASHBOARD
    Route::get('dashboard', [PelangganController::class, 'dashboard'])
        ->name('pelanggan.dashboard');
    //PROFIL
    Route::put('/pelanggan/update', [PelangganController::class, 'updateProfil'])
        ->name('pelanggan.profile');
    Route::get('/pelanggan/profile', [PelangganController::class, 'profil'])
        ->name('pelanggan.profil');
    Route::put('/pelanggan/update', [PelangganController::class, 'updateProfil'])
        ->name('pelanggan.updateProfil');
    Route::get('/pelanggan/update', [PelangganController::class, 'updateProfil'])
        ->name('pelanggan.profile');
});

//DASHBOARD ADMIN
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('adminAuthCheck');

Route::get('admin/menu', [AdminController::class, 'indexMenu'])->name('admin.menu.index');

