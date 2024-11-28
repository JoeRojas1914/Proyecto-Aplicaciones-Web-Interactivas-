<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGenre extends Model
{
    protected $table = 'users_genres';

    protected $fillable = [
        'user_id', 
        'genre_id',
    ];
}
