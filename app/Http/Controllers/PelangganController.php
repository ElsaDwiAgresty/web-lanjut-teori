<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;
use App\Models\MenuModel;
use App\Models\PesananModel;
use App\Models\ReservasiModel;
use App\Models\UlasanModel;

class PelangganController extends Controller
{
    // Menampilkan form reservasi
    public function indexReservasi()
    {
        $menuItems = MenuModel::all();
        return view('Pelanggan/Reservasi/create_reservasi', compact('menuItems'));
    }

    // Menyimpan data reservasi
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tipeReservasi' => 'required|string|max:255',
            'nomorMeja' => 'required|string|max:255',
        ]);

        // Buat objek reservasi baru
        $reservasi = new ReservasiModel();
        $reservasi->nama = $validated['nama'];
        $reservasi->tipe_reservasi = $validated['tipe_reservasi'];
        $reservasi->nomor_meja = $validated['nomor_meja'];
        
        // Simpan ke database
        $reservasi->save();

        // Redirect kembali ke halaman form dengan pesan sukses
        return redirect()->route('reservasi')->with('success', 'Reservasi berhasil dibuat!');
    }

    public function indexRegistrasi()
    {
        return view('registrasi');
    }
}
