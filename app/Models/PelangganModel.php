<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;


class PelangganModel extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
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

    public function getPelanggan($id = null) {
        if($id != null) {
            return $this->where('pelanggan.id_pelanggan', $id)->first();
        }
        return $this->all();
    }
}
