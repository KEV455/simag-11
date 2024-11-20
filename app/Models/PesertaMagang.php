<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaMagang extends Model
{
    protected $fillable = [
        'tanggal_disetujui',
        'id_pelamar_magang',
    ];

    public function pelamar_magang()
    {
        return $this->belongsTo(PelamarMagang::class, 'id_pelamar_magang', 'id');
    }
    public function logbook()
    {
        return $this->hasMany(Logbook::class);
    }
    public function laporan_akhir_magang()
    {
        return $this->hasMany(LaporanAkhirMagang::class);
    }
}
