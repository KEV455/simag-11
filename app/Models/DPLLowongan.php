<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DPLLowongan extends Model
{
    protected $table = 'dpl_lowongans';

    protected $fillable = [
        'id',
        'id_dpl_mitra',
        'id_lowongan',
    ];

    public function dpl_mitra()
    {
        return $this->belongsTo(DPLMitra::class, 'id_dpl_mitra', 'id');
    }
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan', 'id');
    }
}
