<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'jumlah_lowongan',
        'deskripsi',
        'tanggal_dibuka',
        'tanggal_ditutup',
        'tanggal_magang_dimulai',
        'tanggal_magang_ditutup',
        'status',
        'id_mitra'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }

    public function berkas_lowongan()
    {
        return $this->hasMany(BerkasLowongan::class);
    }
    public function lowongan_prodi()
    {
        return $this->hasMany(LowonganProdi::class, 'id_lowongan', 'id');
    }
}
