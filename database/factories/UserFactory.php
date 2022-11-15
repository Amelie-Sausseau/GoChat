<?php

namespace Database\Factories;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pseudo' => fake()->name(),
            'image' => 'default_user.jpg',
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make(fake()->name()),
            'remember_token' => Str::random(10),
        ];
    }
}
