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
        return $this->hasMany(Lowongan::class);
    }
    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }
}
