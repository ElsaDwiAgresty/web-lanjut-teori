<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\ReservasiModel;
use App\Models\UlasanModel;
use App\Models\PelangganModel;

class AdminController extends Controller
{
    //DASHBOARD
    public function dashboard()
    {
        return view('Admin.dashboardAdmin'); // Pastikan path view sesuai
    }

    // Kelola Menu
    public function indexMenu()
    {
        $menuItems = MenuModel::all();
        return view('Admin.Kelola.menu', compact('menuItems'));
    }

    public function createMenu()
    {
        return view('admin.menu.create');
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        MenuModel::create($request->all());
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function editMenu($id)
    {
        $menu = MenuModel::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function updateMenu(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        $menu = MenuModel::findOrFail($id);
        $menu->update($request->all());
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroyMenu($id)
    {
        $menu = MenuModel::findOrFail($id);
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus.');
    }

    //Kelola Pelanggan
    public function indexPelanggan()
    {
        $pelangganItems = PelangganModel::all(); // Ambil data pelanggan dari database
        return view('Admin.Pelanggan.kelola-pelanggan', compact('pelangganItems')); // Tampilkan view
    }


    public function editPelanggan($id_pelanggan)
{
    $pelanggan = PelangganModel::findOrFail($id_pelanggan);
    return view('Admin.Pelanggan.edit-pelanggan', compact('pelanggan')); // Pastikan nama view sesuai
}

    public function updatePelanggan(Request $request, $id_pelanggan)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|string',
            'no_hp' => 'nullable|string',
        ]);

        $pelanggan = PelangganModel::findOrFail($id_pelanggan);
        $pelanggan->update($request->all());
        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil diupdate.');
    }

    public function destroyPelanggan($id_pelanggan)
    {
        $pelanggan = PelangganModel::findOrFail($id_pelanggan);
        $pelanggan->delete();
        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }

    //kelola reservasi
    public function indexReservasi()
    {
        $reservasiItems = ReservasiModel::all(); // Ambil data pelanggan dari database
        return view('Admin.Reservasi.kelola-reservasi', compact('reservasiItems')); // Tampilkan view
    }

    public function updateStatusReservasi(Request $request, $id_reservasi)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:OK,Dalam Antrian,Ditolak',
        ]);

        // Cari data reservasi berdasarkan ID
        $reservasi = ReservasiModel::where('id_reservasi', $id_reservasi)->firstOrFail();
        $reservasi->status = $request->status; // Ubah status
        $reservasi->save(); // Simpan perubahan

        // Redirect dengan pesan sukses
        return redirect()->route('admin.reservasi.index')
            ->with('success', 'Status reservasi berhasil diubah.');
    }

    public function editReservasi($id_reservasi)
{
    $reservasi = ReservasiModel::findOrFail($id_reservasi);
    return view('Admin.reservasi.edit-reservasi', compact('reservasi')); // Pastikan nama view sesuai
}

    public function updateReservasi(Request $request, $id_reservasi)
    {
        $request->validate([
            'id_pelanggan' => 'required|numeric',
            'tipe_reservasi' => 'required|string',
            'nomor_meja' => 'required|numeric',
            'tgl_reservasi' => 'required|date',
            'waktu_reservasi' => 'required|time',
        ]);

        $reservasi = ReservasiModel::findOrFail($id_reservasi);
        $reservasi->update($request->all());
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil diupdate.');
    }

    public function destroyReservasi($id_reservasi)
    {
        $reservasi = ReservasiModel::findOrFail($id_reservasi);
        $reservasi->delete();
        return redirect()->route('admin.reservasi.index')->with('success', 'reservasi berhasil dihapus.');
    }

}
