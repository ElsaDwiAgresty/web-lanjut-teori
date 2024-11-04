<?php

namespace Database\Seeders;

use App\Models\MenuModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // MenuModel::create([
    //     'nama_menu' => 'Nasi Goreng',
    //     'harga_menu' => 15000,
    //     'foto_menu' => 'https://via.placeholder.com/150'
    // ]);

    // MenuModel::create([
    //     'nama_menu' => 'Jus Jeruk',
    //     'harga_menu' => 10000,
    //     'foto_menu' => 'https://via.placeholder.com/150'
    // ]);

    MenuModel::create([
        'nama_menu' => 'Jus Jambu',
        'harga_menu' => 10000,
        'foto_menu' => 'https://via.placeholder.com/150'
    ]);
}
}
