<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $guarded = ['id_menu'];
    protected $primaryKey = 'id_menu';
    protected $fillable = [
        'nama_menu',
        'harga_menu',
        'foto_menu'
    ];

    public function pesanan() {
        return $this->hasMany(PesananModel::class, 'id_pesanan');
    }

    public function getMenu() {
        return $this->all();
    }
}
