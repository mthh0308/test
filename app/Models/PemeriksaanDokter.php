<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanDokter extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaandokter_t';

    protected $fillable = [
        'id_pasien',
        'keluhan',
        'diagnosa',
        'tglperiksadokter',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
}
