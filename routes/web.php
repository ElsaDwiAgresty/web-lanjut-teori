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
Route::get('/admin/menu/create', [AdminController::class, 'createMenu'])->name('admin.menu.create');
Route::post('/admin/menu/store', [AdminController::class, 'storeMenu'])->name('admin.menu.store');
Route::get('/menu/edit/{id}', [AdminController::class, 'editMenu'])->name('menu.edit');
Route::put('/menu/update/{id}', [AdminController::class, 'updateMenu'])->name('menu.update');
Route::delete('/menu/delete/{id}', [AdminController::class, 'destroyMenu'])->name('menu.delete');


//PELANGGAN
Route::get('pelanggan', [AdminController::class, 'indexPelanggan'])
    ->name('admin.pelanggan.index');
Route::get('/pelanggan/edit/{id}', [AdminController::class, 'editPelanggan'])
    ->name('admin.pelanggan.editPelanggan');
Route::put('/pelanggan/update/{id}', [AdminController::class, 'updatePelanggan'])
    ->name('admin.pelanggan.updatePelanggan');
Route::delete('/pelanggan/{id}', [AdminController::class, 'destroyPelanggan'])
    ->name('admin.pelanggan.destroy');

//RESERVASI ADMIN
Route::get('reservasi', [AdminController::class, 'indexReservasi'])
    ->name('admin.reservasi.index');
Route::post('/reservasi/{id}/update-status', [AdminController::class, 'updateStatusReservasi'])
    ->name('admin.reservasi.updateStatus');
Route::get('/reservasi/edit/{id}', [AdminController::class, 'editReservasi'])
    ->name('admin.reservasi.editReservasi');
Route::put('/reservasi/update/{id}', [AdminController::class, 'updateReservasi'])
    ->name('admin.reservasi.updateReservasi');
Route::delete('/reservasi/{id}', [AdminController::class, 'destroyReservasi'])
    ->name('admin.reservasi.destroy');

//HOME
Route::get('/', [PelangganController::class, 'indexHome'])
    ->name('home');

//ULASAN
Route::post('ulasan/submit', [PelangganController::class, 'storeUlasan'])
    ->name('pelanggan.ulasan.store')
    ->middleware('pelangganAuthCheck');
Route::get('ulasan', [PelangganController::class, 'indexUlasan'])
    ->name('pelanggan.ulasan.index');

Route::get('ulasanAdmin', [AdminController::class, 'Ulasan'])
    ->name('admin.ulasan.index');
Route::delete('/ulasan/{id}', [AdminController::class, 'destroyUlasan'])
    ->name('admin.ulasan.destroy');

Route::post('/admin/ulasan/{id}/reply', [AdminController::class, 'replyUlasan'])->name('admin.ulasan.reply');


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

//DASHBOARD PELANGGAN
Route::middleware('pelangganAuthCheck')->group(function() {
    //DASHBOARD
    Route::get('dashboard', [PelangganController::class, 'dashboard'])
        ->name('pelanggan.dashboard');
    //PROFIL
    Route::get('dashboard/profile', [PelangganController::class, 'profil'])
        ->name('pelanggan.profil');
    Route::put('dashboard/profile/update', [PelangganController::class, 'updateProfil'])
        ->name('pelanggan.updateProfil');
    //RESERVASI
    Route::get('reservasi/create', [PelangganController::class, 'indexReservasi'])
        ->name('pelanggan.reservasi.create');
    Route::post('reservasi/store', [PelangganController::class, 'storeReservasi'])
        ->name('pelanggan.reservasi.store');
    Route::get('dashboard/reservasi-saya', [PelangganController::class, 'reservasiSaya'])
        ->name('reservasi.saya');
});

//DASHBOARD ADMIN
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware('adminAuthCheck');

Route::get('admin/menu', [AdminController::class, 'indexMenu'])->name('admin.menu.index');
