<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelamarMagang extends Model
{
    protected $fillable = [
        'status_diterima',
        'id_mahasiswa',
        'id_lowongan',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan', 'id');
    }
    public function berkas_pelamar()
    {
        return $this->hasMany(BerkasPelamar::class);
    }
    public function peserta_magang()
    {
        return $this->hasMany(PesertaMagang::class);
    }
}
