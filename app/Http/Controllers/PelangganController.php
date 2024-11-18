<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;
use App\Models\PesananModel;
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
        return view('Pelanggan.Reservasi.create_reservasi', compact('menuItems'));
    }

    public function reservasiSaya()
    {
        // Ambil data reservasi berdasarkan id pelanggan yang sedang login
        $reservasi = ReservasiModel::where('id_pelanggan', session('id_pelanggan'))->get();

        // Tampilkan halaman dengan data reservasi
        return view('Pelanggan.Reservasi.reservasi-saya', ['reservasi' => $reservasi]);
    }


    // Menyimpan data reservasi
    public function storeReservasi(Request $request)
    {
        // Validasi input
        $request->validate([
            'tipe_reservasi' => 'required',
            'nomor_meja' => 'required',
            'tgl_reservasi' => 'required',
            'waktu_reservasi' => 'required'
        ]);
        
        // Simpan data reservasi ke dalam tabel
        $this->reservasiModel->create([
            'id_pelanggan' => session('id_pelanggan'),  
            'tipe_reservasi' => $request->input('tipe_reservasi'),
            'nomor_meja' => $request->input('nomor_meja'),
            'status' => 'Dalam Antrian',  
            'tgl_reservasi' => $request->input('tgl_reservasi'),
            'waktu_reservasi' => $request->input('waktu_reservasi')
        ]);

        return redirect()->route('pelanggan.dashboard')->with('success', 'Reservasi berhasil dibuat.');
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

    //PROFIL

    public function profil()
    {
        $data = array();
        if($id = Session::get('id_pelanggan')){
            $data = $this->pelangganModel->getPelanggan($id);
        }
        return view('Pelanggan.profile', compact('data'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:pelanggan,email,' . session('id_pelanggan') . ',id_pelanggan', // Validasi email unik dengan pengecualian email pelanggan saat ini
            'password' => 'nullable|string|min:6',
        ]);

        // Ambil data pelanggan berdasarkan sesi login
        $pelanggan = PelangganModel::find(session('id_pelanggan'));

        if (!$pelanggan) {
            return redirect()->route('pelanggan.profil')->withErrors('Pelanggan tidak ditemukan.');
        }

        // Update data pelanggan
        $pelanggan->nama = $request->input('nama');
        $pelanggan->no_hp = $request->input('no_hp');
        $pelanggan->email = $request->input('email');

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $pelanggan->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $pelanggan->save();

        return redirect()->route('pelanggan.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }


    //PESANAN
    public function storePesanan(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_reservasi' => 'required|exists:reservasi,id', // Pastikan id_reservasi ada di tabel reservasi
            'menu' => 'required|array', // Asumsikan menu adalah array dari id_menu yang dipilih
            'menu.*.jumlah' => 'required|integer|min:1',
            'menu.*.harga' => 'required|numeric|min:0',
        ]);

        // Ambil id_pelanggan dari sesi login
        $id_pelanggan = session('id_pelanggan');
        
        // Pastikan id_reservasi berelasi dengan id_pelanggan yang sedang login
        $reservasi = ReservasiModel::where('id', $request->input('id_reservasi'))
                                ->where('id_pelanggan', $id_pelanggan)
                                ->first();

        if (!$reservasi) {
            return redirect()->back()->withErrors('Reservasi tidak ditemukan atau tidak berhubungan dengan pelanggan ini.');
        }

        // Simpan setiap pesanan yang berhubungan dengan reservasi
        foreach ($request->input('menu') as $menuItem) {
            PesananModel::create([
                'id_pelanggan' => $id_pelanggan,          // ID pelanggan dari sesi
                'id_reservasi' => $reservasi->id,         // ID reservasi yang dipilih
                'jumlah' => $menuItem['jumlah'],
                'harga_total' => $menuItem['jumlah'] * $menuItem['harga'], // Hitung harga total
                'id_menu' => $menuItem['id'], // id_menu dari menu item
            ]);
        }

        return redirect()->route('pelanggan.dashboard')->with('success', 'Pesanan berhasil dibuat.');
    }


}
