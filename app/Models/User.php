<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Get the posts that the user has liked.
     *
     * This function defines a MANY-TO-MANY relationship between the User and Post models
     * through the 'user_likes' pivot table. It retrieves only the posts where the pivot
     * table's 'reaction' column has the value 'like'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'user_likes', 'user_id', 'post_id')
            ->wherePivot('reaction', 'like');
    }

    
    /**
     * Get the users that the user is following.
     *
     * This function defines a MANY-TO-MANY relationship between the User model
     * and itself through the 'followers' pivot table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id');
    }

    /**
     * Get the followers of the user.
     *
     * This function defines a MANY-TO-MANY relationship between the User model
     * and itself through the 'followers' pivot table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id');
    }

    /**
     * Get the list of movies that the user has in their watch list.
     *
     * This function establishes a many-to-many relationship between the User model
     * and the WatchList model. It returns the IDs of the movies that the user has
     * added to their watch list.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function watch_list()
    {
        // Se usa para retornar los IDs de las películas que el usuario tiene en su lista de seguimiento
        return $this->belongsToMany(WatchList::class, 'watch_list', 'user_id', 'movie_id');
    }


    /**
     * Define a many-to-many relationship between User and UserGenre.
     *
     * This function establishes a relationship where a user can belong to multiple genres
     * and a genre can belong to multiple users. It uses the 'users_genres' pivot table
     * with 'user_id' as the foreign key for the User model and 'genre_id' as the foreign key
     * for the UserGenre model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(UserGenre::class, 'users_genres', 'user_id', 'genre_id');
    }
}
