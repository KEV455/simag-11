<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DPLMitra extends Model
{
    protected $table = 'dpl_mitras';

    protected $fillable = [
        'id',
        'nama',
        'tanggal_lahir',
        'email',
        'nomor_telp',
        'id_mitra',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id');
    }

    public function dpl_lowongan()
    {
        return $this->hasMany(DPLLowongan::class);
    }

    public function nilai_dpl()
    {
        return $this->hasMany(NilaiDPL::class);
    }
}
