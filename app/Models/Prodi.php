<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = [
        'id',
        'nama_program_studi',
        'jenjang_pendidikan',
        'id_jurusan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}