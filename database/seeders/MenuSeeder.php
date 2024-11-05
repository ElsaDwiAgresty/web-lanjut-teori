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
    MenuModel::create([
        'nama_menu' => 'Nasi Goreng',
        'harga_menu' => 15000,
        'foto_menu' => 'public\img\NasiGoreng.jpg'
    ]);

    MenuModel::create([
        'nama_menu' => 'Jus Jeruk',
        'harga_menu' => 10000,
        'foto_menu' => 'public\img\JusJeruk.jpeg'
    ]);

    MenuModel::create([
        'nama_menu' => 'Jus Jambu',
        'harga_menu' => 10000,
        'foto_menu' => 'public\img\JusJambu.jpeg'
    ]);
}
}
