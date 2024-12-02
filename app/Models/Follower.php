<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Likes extends Model
{
    protected $table = 'followers';
    public $timestamps = true;

    protected $fillable = [
        'follower_id', 
        'followed_id',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
