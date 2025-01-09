<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'id',
        'kode_semester',
        'nama_semester',
        'semester',
        'tahun_ajaran',
    ];

    public function tahun_ajaran()
    {
        return $this->hasMany(TahunAjaran::class);
    }
}
