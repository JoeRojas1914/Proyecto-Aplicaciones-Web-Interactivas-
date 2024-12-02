<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Likes_Dislikes extends Model
{
    protected $table = 'user_likes_dislikes';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'post_id',
        'likes',
        'dislike',
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
