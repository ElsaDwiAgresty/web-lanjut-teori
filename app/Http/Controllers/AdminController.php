<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        return view('admin.kelola.create-menu');
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga_menu' => 'required|numeric',
            'foto_menu' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoMenuPath = null;

        if ($request->hasFile('foto_menu')) {
            $originalFileName = $request->file('foto_menu')->getClientOriginalName();
            $request->file('foto_menu')->move(public_path('img'), $originalFileName);
            $fotoMenuPath = 'img/' . $originalFileName;
        }

        MenuModel::create([
            'nama_menu' => $request->nama_menu,
            'harga_menu' => $request->harga_menu,
            'foto_menu' => $fotoMenuPath,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }


    public function editMenu($id_menu)
    {
        // Pastikan primary key di model sudah sesuai
        $menu = MenuModel::findOrFail($id_menu);
        return view('admin.kelola.edit-menu', compact('menu'));
    }

    public function updateMenu(Request $request, $id_menu)
    {
        // Validasi inputan
        $request->validate([
            'foto_menu' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
            'nama_menu' => 'required|string|max:255', // Batas panjang string
            'harga_menu' => 'required|numeric|min:0', // Harga minimal 0
        ]);

        // Ambil data menu dari database berdasarkan id
        $menu = MenuModel::findOrFail($id_menu);

        // Jika ada file foto baru yang diunggah
        if ($request->hasFile('foto_menu')) {
            // Hapus foto lama jika ada
            if ($menu->foto_menu && file_exists(public_path($menu->foto_menu))) {
                unlink(public_path($menu->foto_menu));
            }

            // Upload file baru
            $originalFileName = $request->file('foto_menu')->getClientOriginalName();
            $request->file('foto_menu')->move(public_path('img'), $originalFileName);
            $menu->foto_menu = 'img/' . $originalFileName; // Update path foto di database
        }

        // Update data menu lainnya
        $menu->nama_menu = $request->input('nama_menu');
        $menu->harga_menu = $request->input('harga_menu');

        // Simpan perubahan ke database
        $menu->save();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diupdate.');
    }


    public function destroyMenu($id_menu)
    {
        $menu = MenuModel::findOrFail($id_menu);
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
        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|string',
            'no_hp' => 'nullable|string',
            'alamat' => 'required|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,avif|max:2048',
        ]);

        $pelanggan = PelangganModel::findOrFail($id_pelanggan);

        if (!$pelanggan) {
            return redirect()->route('admin.pelanggan.index')->with('error', 'Pelanggan tidak ditemukan.');
        }

        $pelanggan->nama = $request->input('nama');
        $pelanggan->no_hp = $request->input('no_hp');
        $pelanggan->email = $request->input('email');
        $pelanggan->alamat = $request->input('alamat');

        if($request->hasFile('foto_profil')) {
            $fileName = time() . '_' . $validated['nama'] . '.' . $request->foto_profil->extension();
            $request->foto_profil->move(public_path('img/profile'), $fileName);
            $pelanggan->foto_profil = 'img/profile/' . $fileName;
        }

        $pelanggan->save();

        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil diupdate.');
    }

    public function destroyPelanggan($id_pelanggan)
    {
        $pelanggan = PelangganModel::findOrFail($id_pelanggan);
        $pelanggan->delete();
        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }

    public function updateStatusPelanggan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:Aktif,NonAktif', // Status hanya boleh Aktif atau NonAktif
        ]);

        // Cari pelanggan berdasarkan ID
        $pelanggan = PelangganModel::find($id);

        if (!$pelanggan) {
            return redirect()->route('admin.pelanggan.index')->with('error', 'Pelanggan tidak ditemukan.');
        }

        // Update status pelanggan
        $pelanggan->status = $request->status;
        $pelanggan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.pelanggan.index')->with('success', 'Status pelanggan berhasil diperbarui.');
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
            'waktu_reservasi' => 'required|date_format:H:i',
        ]);

        $reservasi = ReservasiModel::findOrFail($id_reservasi);
        $reservasi->update($request->all());
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil diupdate.');
    }

    public function destroyReservasi($id_reservasi)
    {
        $reservasi = ReservasiModel::findOrFail($id_reservasi);
        $reservasi->delete();
        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }

    //kelola ulasan
    public function Ulasan()
    {
        $ulasanItems = UlasanModel::all(); // Ambil data pelanggan dari database
        return view('Admin.Ulasan.kelola-ulasan', compact('ulasanItems')); // Tampilkan view
    }

    public function replyUlasan(Request $request, $id_ulasan)
    {
        $ulasan = UlasanModel::where('id_ulasan', $id_ulasan)->firstOrFail();
        $ulasan->balasan = $request->balasan;
        $ulasan->save();

        return redirect()->route('admin.ulasan.index')->with('success', 'Balasan berhasil dikirim.');
    }

    public function destroyUlasan($id_ulasan)
    {
        $ulasan = UlasanModel::findOrFail($id_ulasan);
        $ulasan->delete();
        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil dihapus.');
    }

}
