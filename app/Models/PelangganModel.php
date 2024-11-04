<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganModel extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $guarded = ['id_pelanggan'];
    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'password'
    ];
    protected $hidden = [
        'password'
    ];
    
    public function reservasi() {
        return $this->hasMany(ReservasiModel::class, 'id_reservasi');
    }

    public function ulasan() {
        return $this->hasMany(UlasanModel::class, 'id_ulasan');
    }

    public function getPelanggan() {
        return $this->all();
    }
}
