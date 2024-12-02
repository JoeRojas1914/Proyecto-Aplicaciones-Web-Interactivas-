<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', // Usuario que ha escrito la reseña
        'movie_id',
        'title',
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

    /**
     * Get all the users who have liked the post.
     *
     * This function defines a MANY-TO-MANY relationship between the Post model and the User model.
     * It retrieves all users who have liked the post by filtering the pivot table 'user_likes' 
     * where the 'reaction' column is 'like'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    
    public function likes()
    {
        return $this->belongsToMany(User::class, 'user_likes', 'post_id', 'user_id')
            ->wherePivot('reaction', 'like');
            // ->withTimestamps();
    }
}
