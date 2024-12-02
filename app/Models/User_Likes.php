<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Likes extends Model
{
    protected $table = 'user_likes';
    public $timestamps = true;

    protected $fillable = [
        'user_id', 
        'post_id',
        'reaction',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
