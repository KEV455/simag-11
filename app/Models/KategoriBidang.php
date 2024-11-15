<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBidang extends Model
{
    protected $fillable = [
        'id',
        'nama_kategori',
    ];

    public function mitra()
    {
        return $this->hasMany(Mitra::class);
    }
}
