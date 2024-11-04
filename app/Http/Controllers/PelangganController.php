<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;
use App\Models\MenuModel;
use App\Models\PesananModel;
use App\Models\ReservasiModel;
use App\Models\UlasanModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
            'tipe_reservasi' => 'required|string|max:255',
            'nomor_meja' => 'required|string|max:255',
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

    public function storeRegistrasi(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'no_hp' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            'email' => 'required|string|max:255|unique:pelanggan,email',
            'password' => 'required|string|min:8|max:255',
        ]);

        // Buat objek reservasi baru
        $registrasi = new PelangganModel();
        $registrasi->nama = $validated['nama'];
        $registrasi->no_hp = $validated['no_hp'];
        $registrasi->email = $validated['email'];
        $registrasi->password = Hash::make($validated['password']);;
        
        // Simpan ke database
        $registrasi->save();

        // Redirect kembali ke halaman form dengan pesan sukses
        return redirect()->route('pelanggan.login')->with('success', 'Registrasi berhasil, silahkan login.');
    }

    public function indexLogin()
    {
        return view('login');
    }


    public function login(Request $request)
    {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Cari pengguna berdasarkan email
    $user = PelangganModel::where('email', $credentials['email'])->first();

    // Jika pengguna ditemukan dan password sesuai
    if ($user && Hash::check($credentials['password'], $user->password)) {
        // Simpan data pengguna ke sesi sebagai autentikasi manual
        Auth::login($user);
        
        // Redirect ke halaman dashboard atau halaman lain yang sesuai
        return redirect()->route('pelanggan.login')->with('success', 'Anda berhasil login!');
    }

    // Jika login gagal
    return back()->withErrors(['login' => 'Email atau password salah.']);
}
}
