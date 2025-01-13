<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanDosenPembimbing extends Model
{
    protected $fillable = [
        'id_semester',
        'id_mahasiswa',
        'id_dosen_pembimbing',
        'status'
    ];


    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }

    public function dosen_pembimbing()
    {
        return $this->belongsTo(DosenPembimbing::class, 'id_dosen_pembimbing', 'id');
    }
}
