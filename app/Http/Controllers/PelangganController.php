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

    //RESERVASI
    // Menampilkan form reservasi
    public function indexReservasi()
    {
        $menuItems = $this->menuModel->getMenu();
        return view('Pelanggan/Reservasi/create_reservasi', compact('menuItems'));
    }

    public function reservasiSaya()
    {
        // Cek apakah user sudah login
        if (!session()->has('id_pelanggan')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data reservasi berdasarkan id pelanggan yang sedang login
        $reservasi = ReservasiModel::where('id_pelanggan', session('id_pelanggan'))->get();

        // Tampilkan halaman dengan data reservasi
        return view('Pelanggan.Reservasi.reservasi-saya', ['reservasi' => $reservasi]);
    }


    // Menyimpan data reservasi
    public function storeReservasi(Request $request)
    {
        // Cek apakah user sudah login
        if (!session()->has('id_pelanggan')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Validasi input
        $request->validate([
            'tipe_reservasi' => 'required',
            'nomor_meja' => 'required',
        ]);

        // Simpan data reservasi ke dalam tabel
        ReservasiModel::create([
            'id_pelanggan' => session('id_pelanggan'),  
            'tipe_reservasi' => $request->input('tipe_reservasi'),
            'nomor_meja' => $request->input('nomor_meja'),
            'status' => 'Dalam Antrian',  
        ]);

        return redirect()->route('pelanggan.dashboard')->with('success', 'Reservasi berhasil dibuat.');
    }

    //REGISTRASI
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

        // Buat objek registrasi baru
        $this->pelangganModel->nama = $validated['nama'];
        $this->pelangganModel->no_hp = $validated['no_hp'];
        $this->pelangganModel->email = $validated['email'];
        $this->pelangganModel->password = Hash::make($validated['password']);;
        
        // Simpan ke database
        $this->pelangganModel->save();

        // Redirect kembali ke halaman form dengan pesan sukses
        return redirect()->route('pelanggan.login')->with('success', 'Registrasi berhasil, silahkan login.');
    }

    //LOGIN
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
            $request->session()->put('id_pelanggan', $user->id_pelanggan);

            // dd(Auth::check()); // Tambahkan ini untuk memeriksa status login
            
            // Redirect ke halaman dashboard 
            return redirect()->route('pelanggan.dashboard')->with('success', 'Anda berhasil login!');
        }

        // Jika login gagal
        return back()->withErrors(['login' => 'Email atau password salah.']);
    }

    //DASHBOARD
    public function dashboard()
    {
        // Ambil data pengguna yang login
        $data = array();
        if($id = Session::get('id_pelanggan')){
            $data = $this->pelangganModel->getPelanggan($id);
        }
        return view('pelanggan/dashboardPelanggan', compact('data'));
    }

    //MENU
    public function indexMenu()
    {
        $menuItems = $this->menuModel->getMenu(); // Ambil semua item menu dari database
        return view('home', compact('menuItems'));
    }

    //HOME
    public function indexHome()
    {
        // Ambil data menu dari database
        $menuItems = $this->menuModel->getMenu();

        $user = array();
        if($id = session('id_pelanggan'))
            $user = $this->pelangganModel->getPelanggan($id);

        return view('home', compact('menuItems', ['user']));
    }

    //LOGOUT
    public function logout()
    {
        if(Session::has('id_pelanggan')){
            Session::pull('id_pelanggan');
            return redirect()->route('home');
        }
    }

    //PROFIL
    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nohp' => 'required|string|max:15',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        $user = auth()->user();
        $user->nama = $request->nama;
        $user->nohp = $request->nohp;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('pelanggan.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }

}
