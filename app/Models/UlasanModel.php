<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanModel extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    protected $guarded = ['id_ulasan'];
    protected $fillable = [
        'id_pelanggan',
        'ulasan'
    ];

    public function pelanggan() {
        return $this->belongsTo(PelangganModel::class, 'id_pelanggan');
    }

    public function getUlasan() {
        return $this->all();
    }
}
