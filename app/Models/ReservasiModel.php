<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiModel extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';
    protected $guarded = ['id_reservasi'];
    protected $fillable = [
        'id_pelanggan',
        'tipe_reservasi',
        'nomor_meja',
        'status',
        'tgl_reservasi',
        'waktu_reservasi'
    ];

    public function pelanggan() {
        return $this->belongsTo(PelangganModel::class, 'id_pelanggan');
    }

    public function pesanan() {
        return $this->hasMany(PesananModel::class, 'id_pesanan');
    }

    public function getReservasi() {
        return $this->all();
    }
}
