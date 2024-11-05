<?php

namespace Database\Seeders;

use App\Models\PelangganModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PelangganModel::create([
            'nama' => 'Vitto',
            'email' => 'nvittoa@gmail.com',
            'no_hp' => '081111111111',
            'password' => Hash::make('testtest123')
        ]);
    }
}
