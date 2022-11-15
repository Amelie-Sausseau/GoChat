<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
    public function definition()
    {
        return [
            'content' => $this->faker->paragraph(),
            'image' => 'default_user.jpg',
            'tags' => $this->faker->words(3, true),
            'user_id' => rand(1, User::count()),
            'titre' => $this->faker->sentence()
        ];
    }
}
