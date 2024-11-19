<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraMandiri extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'alamat',
        'kota',
        'provinsi',
        'narahubung',
        'email',
        'status_disetujui',
        'id_mahasiswa',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
}
