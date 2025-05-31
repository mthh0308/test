<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien_m';

    protected $fillable = [
        'nocm',
        'nama_pasien',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'no_hp',
    ];

    public function pemeriksaanPerawat()
    {
        return $this->hasMany(PemeriksaanPerawat::class, 'id_pasien');
    }

    public function pemeriksaanDokter()
    {
        return $this->hasMany(PemeriksaanDokter::class, 'id_pasien');
    }

    public function resepObat()
    {
        return $this->hasMany(ResepObat::class, 'id_pasien');
    }

}
