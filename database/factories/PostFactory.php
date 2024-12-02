<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Services\MovieApiService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topRatedMovies = MovieApiService::getTopRatedMovies();
        $topRatedMovies = $topRatedMovies['results'];
        $randomNumber = $this->faker->numberBetween(0, 19); // 20 top rated movies que arroja la API
        return [
            'user_id' => $this->faker->numberBetween(1, 2), // Usa el usuario normal o el critico
            'movie_id' => $topRatedMovies[$randomNumber]['id'],
            'title' => $topRatedMovies[$randomNumber]['title'],
            'content' => $this->faker->paragraph,
            'likes' => 0,
            'dislikes' => 0,
            'rating' => $this->faker->numberBetween(0, 5),
        ];
    }
}
