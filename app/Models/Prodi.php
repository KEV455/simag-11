<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = [
        'id',
        'nama_program_studi',
        'jenjang_pendidikan',
        'kode_prodi',
        'id_jurusan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
    }


    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function lowongan_prodi()
    {
        return $this->hasMany(LowonganProdi::class);
    }

    public function kaprodi()
    {
        return $this->hasMany(Kaprodi::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
