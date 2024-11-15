<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'alamat',
        'kota',
        'provinsi',
        'website',
        'narahubung',
        'email',
        'foto',
        'status',
        'deskripsi',
        'id_kategori_bidang',
    ];

    public function kategori_bidang()
    {
        return $this->belongsTo(KategoriBidang::class, 'id_kategori_bidang', 'id');
    }
}
