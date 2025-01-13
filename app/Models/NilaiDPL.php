<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiDPL extends Model
{
    protected $table = 'nilai_dpls';

    protected $fillable = [
        'id',
        'nilai',
        'id_mahasiswa',
        'id_dpl_mitra',
        'id_kriteria_penilaian',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }

    public function dpl_mitra()
    {
        return $this->belongsTo(DPLMitra::class, 'id_dpl_mitra', 'id');
    }

    public function kriteria_penilaian()
    {
        return $this->belongsTo(KriteriaPenilaian::class, 'id_kriteria_penilaian', 'id');
    }
}
