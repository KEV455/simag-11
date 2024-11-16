<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koordinator extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'email',
        'nomor_telp',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
