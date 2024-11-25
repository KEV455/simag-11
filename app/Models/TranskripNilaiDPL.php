<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranskripNilaiDPL extends Model
{
    protected $fillable = [
        'file_transkrip_nilai',
        'id_peserta_magang'
    ];

    public function peserta_magang()
    {
        return $this->belongsTo(PesertaMagang::class, 'id_peserta_magang', 'id');
    }

    public function nilai_magang()
    {
        return $this->hasMany(NilaiMagang::class);
    }
}
