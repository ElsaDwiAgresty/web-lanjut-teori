<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananModel extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $guarded = ['id_pesanan'];
    protected $fillable = [
        'jumlah',
        'harga_total',
        'id_menu',
        'id_reservasi'
    ];

    public function menu() {
        return $this->belongsTo(MenuModel::class, 'id_menu');
    }

    public function reservasi() {
        return $this->belongsTo(ReservasiModel::class, 'id_reservasi');
    }

    public function getPesanan() {
        return $this->all();
    }
}
