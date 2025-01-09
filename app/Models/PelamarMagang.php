<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelamarMagang extends Model
{
    protected $fillable = [
        'status_diterima',
        'id_mahasiswa',
        'id_lowongan',
        'id_semester',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan', 'id');
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }
    public function berkas_pelamar()
    {
        return $this->hasMany(BerkasPelamar::class, 'id_pelamar_magang', 'id');
    }
    public function peserta_magang()
    {
        return $this->hasMany(PesertaMagang::class, 'id_pelamar_magang');
    }

    public function nilai_magang()
    {
        return $this->hasMany(NilaiMagang::class);
    }
}
