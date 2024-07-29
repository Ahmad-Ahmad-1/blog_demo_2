<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'caption' => fake()->paragraph(rand(3, 7)),
            // 'user_id' => rand(User::, User::)
        ];
    }
}
