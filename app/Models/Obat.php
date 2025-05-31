<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat_m';

    protected $fillable = [
        'nama_obat',
        'satuan',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    public function resepObat()
    {
        return $this->hasMany(ResepObat::class, 'id_obat');
    }

}
