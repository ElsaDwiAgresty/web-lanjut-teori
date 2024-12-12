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

//HOME
Route::get('/', [PelangganController::class, 'indexHome'])
    ->name('home');

//ULASAN UNTUK TAMU
Route::get('ulasan', [PelangganController::class, 'indexUlasan'])
    ->name('pelanggan.ulasan.index');


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

//AUTH PELANGGAN
Route::middleware('pelangganAuthCheck')->group(function() {
    //DASHBOARD
    Route::get('dashboard', [PelangganController::class, 'dashboard'])
        ->name('pelanggan.dashboard');
    //PROFIL
    Route::get('profile', [PelangganController::class, 'profil'])
        ->name('pelanggan.profil');
    Route::put('profile/update', [PelangganController::class, 'updateProfil'])
        ->name('pelanggan.updateProfil');
    //RESERVASI
    Route::get('reservasi/create', [PelangganController::class, 'indexReservasi'])
        ->name('pelanggan.reservasi.create');
    Route::post('/get-waktu', [PelangganController::class, 'getWaktu'])->name('reservasi.getWaktu');
    Route::post('/get-meja', [PelangganController::class, 'getMeja'])->name('reservasi.getMeja');
    Route::post('reservasi/store', [PelangganController::class, 'storeReservasi'])
        ->name('pelanggan.reservasi.store');
    Route::get('reservasi-saya', [PelangganController::class, 'reservasiSaya'])
        ->name('reservasi.saya');
    //SUBMIT ULASAN UNTUK PELANGGAN
    Route::post('ulasan/submit', [PelangganController::class, 'storeUlasan'])
        ->name('pelanggan.ulasan.store');
});

//AUTH ADMIN
Route::middleware('adminAuthCheck')->group(function() {
    //DASHBOARD
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    //KELOLA ULASAN
    Route::get('admin/ulasan', [AdminController::class, 'Ulasan'])
        ->name('admin.ulasan.index');
    Route::delete('admin/ulasan/{id}', [AdminController::class, 'destroyUlasan'])
        ->name('admin.ulasan.destroy');
    Route::post('/admin/ulasan/{id}/reply', [AdminController::class, 'replyUlasan'])
        ->name('admin.ulasan.reply');
    //KELOLA MENU
    Route::get('admin/menu', [AdminController::class, 'indexMenu'])
        ->name('admin.menu.index');
    Route::get('admin/menu/create', [AdminController::class, 'createMenu'])
        ->name('admin.menu.create');
    Route::post('admin/menu/store', [AdminController::class, 'storeMenu'])
        ->name('admin.menu.store');
    Route::get('admin/menu/edit/{id}', [AdminController::class, 'editMenu'])
        ->name('menu.edit');
    Route::put('admin/menu/update/{id}', [AdminController::class, 'updateMenu'])
        ->name('menu.update');
    Route::delete('admin/menu/delete/{id}', [AdminController::class, 'destroyMenu'])
        ->name('menu.delete');
    //KELOLA PELANGGAN
    Route::get('admin/pelanggan', [AdminController::class, 'indexPelanggan'])
        ->name('admin.pelanggan.index');
    Route::get('admin/pelanggan/edit/{id}', [AdminController::class, 'editPelanggan'])
        ->name('admin.pelanggan.editPelanggan');
    Route::put('admin/pelanggan/update/{id}', [AdminController::class, 'updatePelanggan'])
        ->name('admin.pelanggan.updatePelanggan');
    Route::delete('admin/pelanggan/delete/{id}', [AdminController::class, 'destroyPelanggan'])
        ->name('admin.pelanggan.destroy');
    Route::post('admin/pelanggan/updateStatus/{id}', [AdminController::class, 'updateStatusPelanggan'])
        ->name('admin.pelanggan.updateStatusPelanggan');
    //KELOLA RESERVASI
    Route::get('admin/reservasi', [AdminController::class, 'indexReservasi'])
        ->name('admin.reservasi.index');
    Route::post('admin/reservasi/update-status/{id}', [AdminController::class, 'updateStatusReservasi'])
        ->name('admin.reservasi.updateStatus');
    Route::get('admin/reservasi/edit/{id}', [AdminController::class, 'editReservasi'])
        ->name('admin.reservasi.editReservasi');
    Route::put('admin/reservasi/update/{id}', [AdminController::class, 'updateReservasi'])
        ->name('admin.reservasi.updateReservasi');
    Route::delete('admin/reservasi/{id}', [AdminController::class, 'destroyReservasi'])
        ->name('admin.reservasi.destroy');
});
