<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\ReservasiModel;
use App\Models\UlasanModel;
use App\Models\PelangganModel;

class AdminController extends Controller
{
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
}
