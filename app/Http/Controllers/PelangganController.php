<?php

namespace App\Http\Controllers;

use App\Models\UlasanModel;
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
    protected $pelangganModel;
    protected $menuModel;
    protected $reservasiModel;
    protected $ulasanModel;

    public function __construct() {
        $this->pelangganModel = new PelangganModel();
        $this->menuModel = new MenuModel();
        $this->reservasiModel = new ReservasiModel();
        $this->ulasanModel = new UlasanModel();
    }

    // HOME
    public function indexHome()
    {
        $menuItems = $this->menuModel->getMenu();
        $reviews = $this->ulasanModel->getFirstFiveNewestUlasan();

        $user = [];
        if ($id = session('id_pelanggan')) {
            $user = $this->pelangganModel->getPelanggan($id);
        }

        return view('home', compact('menuItems', 'reviews', 'user'));
    }

    // DASHBOARD
    public function dashboard()
    {
        $data = [];
        if ($id = Session::get('id_pelanggan')) {
            $data = $this->pelangganModel->getPelanggan($id);
        }

        $ulasanItems = $this->ulasanModel->where('id_pelanggan', $id)->latest()->get();

        return view('pelanggan.dashboardPelanggan', compact('data', 'ulasanItems'));
    }

    // RESERVASI
    public function indexReservasi()
    {
        $menuItems = $this->menuModel->getMenu();
        return view('Pelanggan.Reservasi.create_reservasi', compact('menuItems'));
    }

    public function reservasiSaya()
    {
        $reservasi = $this->reservasiModel->where('id_pelanggan', session('id_pelanggan'))->get();
        return view('Pelanggan.Reservasi.reservasi-saya', compact('reservasi'));
    }

    public function storeReservasi(Request $request)
    {
        $request->validate([
            'tipe_reservasi' => 'required',
            'nomor_meja' => 'required',
            'tgl_reservasi' => 'required|date|after_or_equal:today|before_or_equal:'.date('Y-m-d', strtotime('+3 days')),
            'waktu_reservasi' => 'required|in:13:00,14:30,17:00,18:00,20:00,20:30',
        ]);

        $this->reservasiModel->create([
            'id_pelanggan' => session('id_pelanggan'),
            'tipe_reservasi' => $request->input('tipe_reservasi'),
            'nomor_meja' => $request->input('nomor_meja'),
            'status' => 'Dalam Antrian',
            'tgl_reservasi' => $request->input('tgl_reservasi'),
            'waktu_reservasi' => $request->input('waktu_reservasi'),
        ]);

        return redirect()->route('pelanggan.dashboard')->with('success', 'Reservasi berhasil dibuat.');
    }

    // ULASAN
    public function indexUlasan()
    {
        $reviews = $this->ulasanModel->getNewestAllUlasan();
        $user = session('id_pelanggan') ? $this->pelangganModel->getPelanggan(session('id_pelanggan')) : [];

        return view('ulasan', compact('reviews', 'user'));
    }

    public function storeUlasan(Request $request)
    {
        $request->validate(['ulasan' => 'required|max:255']);

        $this->ulasanModel->create([
            'id_pelanggan' => session('id_pelanggan'),
            'ulasan' => $request->input('ulasan'),
        ]);

        return redirect()->route('home')->with('success', 'Ulasan berhasil dibuat.');
    }

    // PROFIL
    public function profil()
    {
        $data = [];
        if ($id = Session::get('id_pelanggan')) {
            $data = $this->pelangganModel->getPelanggan($id);
        }

        return view('Pelanggan.profile', compact('data'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:pelanggan,email,' . session('id_pelanggan') . ',id_pelanggan',
            'password' => 'nullable|string|min:6',
        ]);

        $pelanggan = $this->pelangganModel->find(session('id_pelanggan'));

        if (!$pelanggan) {
            return redirect()->route('pelanggan.profil')->withErrors('Pelanggan tidak ditemukan.');
        }

        $pelanggan->nama = $request->input('nama');
        $pelanggan->no_hp = $request->input('no_hp');
        $pelanggan->email = $request->input('email');

        if ($request->filled('password')) {
            $pelanggan->password = Hash::make($request->input('password'));
        }

        $pelanggan->save();

        return redirect()->route('pelanggan.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }
}
