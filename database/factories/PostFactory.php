<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

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
        return [
            'user_id' => $this->faker->numberBetween(1, 2), // Usa el usuario normal o el critico
            'movie_id' => $this->faker->numberBetween(1, 100), // Ajusta según tus necesidades
            'content' => $this->faker->paragraph,
            'likes' => 0,
            'dislikes' => 0,
            'rating' => $this->faker->numberBetween(0, 5),
        ];
    }
}
