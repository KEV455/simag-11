<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasPelamar extends Model
{
    protected $fillable = [
        'file',
        'id_pelamar_magang',
        'id_berkas_lowongan'
    ];

    public function pelamar_magang()
    {
        return $this->belongsTo(PelamarMagang::class, 'id_pelamar_magang', 'id');
    }
    public function berkas_lowongan()
    {
        return $this->belongsTo(BerkasLowongan::class, 'id_berkas_lowongan', 'id');
    }
}
