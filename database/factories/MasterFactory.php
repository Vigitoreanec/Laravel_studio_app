<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master>
 */
class MasterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            //'description' => fake()->realTextBetween(100, 200),
            'description' => fake()->sentence(),
            'email' => $this->faker->unique()->userName . '@nailstudio.com',
            'image' => fake()
                ->imageUrl(640, 480, 'people', true, false),
            //'password' => bcrypt('password'), // Пароль по умолчанию
        ];
    }
}
