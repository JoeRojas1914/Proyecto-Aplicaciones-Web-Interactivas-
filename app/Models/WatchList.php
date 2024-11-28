<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    protected $table = 'watch_list';

    protected $fillable = [
        'user_id',
        'movie_id',
    ];
}
