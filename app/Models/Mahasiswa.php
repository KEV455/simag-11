<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'id',
        'nim',
        'nama_mahasiswa',
        'email',
        'angkatan',
        'jenis_kelamin',
        'id_prodi',
        'id_user',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
