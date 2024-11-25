<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiMagang extends Model
{
    protected $fillable = [
        'nilai_angka',
        'nilai_huruf',
        'validasi',
        'id_peserta_magang',
        'id_laporan_akhir_magang',
        'id_transkrip_nilai_dpl',
    ];

    public function peserta_magang()
    {
        return $this->belongsTo(PesertaMagang::class, 'id_peserta_magang', 'id');
    }

    public function laporan_akhir_magang()
    {
        return $this->belongsTo(LaporanAkhirMagang::class, 'id_laporan_akhir_magang', 'id');
    }

    public function transkrip_nilai_dpl()
    {
        return $this->belongsTo(TranskripNilaiDPL::class, 'id_transkrip_nilai_dpl', 'id');
    }
}
