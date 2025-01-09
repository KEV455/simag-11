<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenPembimbing extends Model
{
    protected $fillable = [
        'status',
        'kuota',
        'id_dosen'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id');
    }

    public function pembimbing_magang()
    {
        return $this->hasMany(PembimbingMagang::class);
    }
}
