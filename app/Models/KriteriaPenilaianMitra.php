<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KriteriaPenilaianMitra extends Model
{
    protected $fillable = [
        'id',
        'id_mitra',
        'id_kriteria_penilaian',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id');
    }
    public function kriteria_penilaian()
    {
        return $this->belongsTo(KriteriaPenilaian::class, 'id_kriteria_penilaian', 'id');
    }
}
