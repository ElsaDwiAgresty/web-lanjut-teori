<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Instansi Model
    public $pelangganModel;

    public function __construct() {
        $this->pelangganModel = new PelangganModel();
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
            $request->session()->put('role', $user->role);

            // dd(Auth::check()); // Tambahkan ini untuk memeriksa status login
            
            // Redirect ke halaman dashboard 
            if(Session::get('role') == 'pelanggan')
                return redirect()->route('pelanggan.dashboard')->with('success', 'Anda berhasil login!');
            else if(Session::get('role') == 'admin')
                return redirect()->route('admin.dashboard')->with('success', 'Anda berhasil login!');
        }

        // Jika login gagal
        return back()->withErrors(['login' => 'Email atau password salah.']);
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
    
    //LOGOUT
    public function logout()
    {
        if(Session::has('id_pelanggan')){
            Session::pull('id_pelanggan');
            return redirect()->route('home');
        }
    }
}
