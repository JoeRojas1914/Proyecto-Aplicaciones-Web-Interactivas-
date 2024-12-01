<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitud';

    protected $fillable = [
        'user_id', 
        'file',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
