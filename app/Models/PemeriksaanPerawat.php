<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanPerawat extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaanperawat_t';

    protected $fillable = [
        'id_pasien',
        'beratbadan',
        'tinggibadan',
        'tekanandarah',
        'suhu',
        'nadi',
        'pernafasan',
        'tglperiksa',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
}
