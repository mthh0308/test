<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekammedis_t';

    protected $fillable = [
        'id_pasien',
        'id_pemeriksaanperawat',
        'id_pemeriksaandokter',
        'id_resepobat',
        'tgl_rekammedis',
        'catatan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function pemeriksaanPerawat()
    {
        return $this->belongsTo(PemeriksaanPerawat::class, 'id_pemeriksaanperawat');
    }

    public function pemeriksaanDokter()
    {
        return $this->belongsTo(PemeriksaanDokter::class, 'id_pemeriksaandokter');
    }

    public function resepObat()
    {
        return $this->belongsTo(ResepObat::class, 'id_resepobat');
    }
}
