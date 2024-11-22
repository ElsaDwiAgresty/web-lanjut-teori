<?php

namespace Database\Seeders;

use App\Models\PelangganModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PelangganModel::create([
            'nama' => 'admin',
            'email' => 'admin@restogo.com',
            'no_hp' => '08123456789',
            'password' => Hash::make('PasswordAdmin'),
            'role' => 'admin'
        ]);
    }
}
