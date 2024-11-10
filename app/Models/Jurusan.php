<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = [
        'id',
        'nama_jurusan',
    ];

    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }
}
