<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanAkhirMagang extends Model
{
    protected $fillable = [
        'file_laporan_akhir',
        'id_peserta_magang'
    ];

    public function peserta_magang()
    {
        return $this->belongsTo(PesertaMagang::class, 'id_peserta_magang', 'id');
    }
}
