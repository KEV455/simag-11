<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'company_name', 'position', 'description', 'start_date', 'end_date', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
