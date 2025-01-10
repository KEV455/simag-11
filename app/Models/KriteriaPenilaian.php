<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KriteriaPenilaian extends Model
{
    protected $fillable = [
        'id',
        'nama_kriteria_penilaian',
        'status',
    ];

    public function kriteria_penilaian_mitra()
    {
        return $this->hasMany(KriteriaPenilaianMitra::class);
    }
}
