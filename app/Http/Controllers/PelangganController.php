<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;
use App\Models\MenuModel;
use App\Models\ReservasiModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PelangganController extends Controller
{
    // Instansi Model
    public $pelangganModel;
    public $menuModel;
    public $reservasiModel;

    public function __construct() {
        $this->pelangganModel = new PelangganModel();
        $this->menuModel = new MenuModel();
        $this->reservasiModel = new ReservasiModel();
    }

    // Menampilkan form reservasi
    public function indexReservasi()
    {
        $menuItems = $this->menuModel->getMenu();
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
        $this->reservasiModel->nama = $validated['nama'];
        $this->reservasiModel->tipe_reservasi = $validated['tipe_reservasi'];
        $this->reservasiModel->nomor_meja = $validated['nomor_meja'];
        
        // Simpan ke database
        $this->reservasiModel->save();

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
        $this->pelangganModel->nama = $validated['nama'];
        $this->pelangganModel->no_hp = $validated['no_hp'];
        $this->pelangganModel->email = $validated['email'];
        $this->pelangganModel->password = Hash::make($validated['password']);;
        
        // Simpan ke database
        $this->pelangganModel->save();

        // Redirect kembali ke halaman form dengan pesan sukses
        return redirect()->route('pelanggan.login')->with('success', 'Registrasi berhasil, silahkan login.');
    }

    public function indexLogin()
    {
        return view('login');
    }

    public function dashboard()
        {
            // Ambil data pengguna yang login
            $data = array();
            if($id = Session::get('id_pelanggan')){
                $data = $this->pelangganModel->getPelanggan($id);
            }
            return view('pelanggan/dashboardPelanggan', compact('data'));
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
            $request->session()->put('id_pelanggan', $user->id_pelanggan);

            // dd(Auth::check()); // Tambahkan ini untuk memeriksa status login
            
            // Redirect ke halaman dashboard 
            return redirect()->route('pelanggan.dashboard')->with('success', 'Anda berhasil login!');
        }

        // Jika login gagal
        return back()->withErrors(['login' => 'Email atau password salah.']);
    }

    public function indexMenu()
    {
        $menuItems = $this->menuModel->getMenu(); // Ambil semua item menu dari database
        return view('home', compact('menuItems'));
    }

    public function indexHome()
    {
        // Ambil data menu dari database
        $menuItems = $this->menuModel->getMenu();

        $user = array();
        if($id = session('id_pelanggan'))
            $user = $this->pelangganModel->getPelanggan($id);

        // Contoh data tipe reservasi dan jumlah kursi kosong
        $reservasiInfo = [
            ['tipe' => 'Family', 'kursi_kosong' => 10],
            ['tipe' => 'VIP', 'kursi_kosong' => 5],
            ['tipe' => 'Couple', 'kursi_kosong' => 8],
            ['tipe' => 'Business', 'kursi_kosong' => 7],
            ['tipe' => 'Group', 'kursi_kosong' => 3],
        ];

        return view('home', compact('menuItems', ['reservasiInfo', 'user']));
    }

    public function logout()
    {
        if(Session::has('id_pelanggan')){
            Session::pull('id_pelanggan');
            return redirect()->route('home');
        }
    }
}
