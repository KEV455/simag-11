<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LowonganProdi extends Model
{
    protected $fillable = [
        'id_lowongan',
        'id_prodi'
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }
}
