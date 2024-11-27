<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'content', 
        'likes', 
        'dislikes', 
        'rating',
    ];

    /**
     * Get the user that the post belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set the rating attribute.
     *
     * This function ensures that the rating value is always between 0 and 5.
     * If the provided value is less than 0, it will be set to 0.
     * If the provided value is greater than 5, it will be set to 5.
     *
     * Laravel llama automáticamente a este método cuando el atributo 'rating' es asignado.
     * @param int $value The rating value to be set.
     */
    public function setRatingAttribute($value)
    {
        $this->attributes['rating'] = max(0, min(5, $value));
    }
}
