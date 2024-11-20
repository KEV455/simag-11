<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasLowongan extends Model
{
    protected $fillable = [
        'id_lowongan',
        'id_berkas'
    ];

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }
    public function berkas()
    {
        return $this->belongsTo(Berkas::class, 'id_berkas');
    }
    public function berkas_lowongan()
    {
        return $this->hasMany(BerkasLowongan::class);
    }
}
