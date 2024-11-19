<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembimbingMagang extends Model
{
    protected  $fillable = [
        'id_dosen_pembimbing',
        'id_mahasiswa'
    ];

    public function dosen_pembimbing()
    {
        return $this->belongsTo(DosenPembimbing::class, 'id_dosen_pembimbing', 'id');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
}
