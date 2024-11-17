<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = [
        'id',
        'nama_dosen',
        'email',
        'nomor_telp',
        'jenis_kelamin',
        'nip',
        'nidn',
        'alamat',
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

    public function dosen_pembimbing()
    {
        return $this->hasMany(DosenPembimbing::class);
    }
}
