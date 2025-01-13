<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'id',
        'kode_semester',
        'nama_semester',
        'semester',
        'tahun_ajaran',
    ];

    public function tahun_ajaran()
    {
        return $this->hasMany(TahunAjaran::class);
    }
    public function lowongan()
    {
        return $this->hasMany(Lowongan::class);
    }
    public function pembimbing_magang()
    {
        return $this->hasMany(PembimbingMagang::class);
    }
    public function permohonan_dosen_pembimbing()
    {
        return $this->hasMany(PermohonanDosenPembimbing::class);
    }
}
