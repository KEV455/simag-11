<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $fillable = [
        'judul_kegiatan',
        'dokumentasi_kegiatan',
        'deskripsi_kegiatan',
        'tanggal_kegiatan',
        'id_peserta_magang'
    ];

    public function peserta_magang()
    {
        return $this->belongsTo(PesertaMagang::class, 'id_peserta_magang', 'id');
    }
}
