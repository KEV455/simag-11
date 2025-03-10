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
        'id_mitra',
        'id_semester'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }

    public function berkas_lowongan()
    {
        return $this->hasMany(BerkasLowongan::class);
    }

    public function lowongan_prodi()
    {
        return $this->hasMany(LowonganProdi::class, 'id_lowongan', 'id');
    }

    public function pelamar_magang()
    {
        return $this->hasMany(PelamarMagang::class, 'id_lowongan', 'id');
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
