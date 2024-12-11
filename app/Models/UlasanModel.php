<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanModel extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    protected $guarded = ['id_ulasan'];
    protected $primaryKey = 'id_ulasan';
    protected $fillable = [
        'id_pelanggan',
        'ulasan',
        'balasan'
    ];

    public function pelanggan() {
        return $this->belongsTo(PelangganModel::class, 'id_pelanggan');
    }

    public function getUlasan() {
        return $this->all();
    }

    public function getFirstFiveNewestUlasan() {
        return $this->orderBy('created_at', 'desc')->take(5)->get();
    }

    public function getNewestAllUlasan() {
        return $this->orderBy('created_at', 'desc')->get();
    }
}
