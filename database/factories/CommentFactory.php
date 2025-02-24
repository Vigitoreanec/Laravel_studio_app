<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Master;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->realText(25, 5),
            'client_id' => Client::inRandomOrder()->first()->id,
            'commentable_id' => Master::inRandomOrder()->first()->id,
            'commentable_type' => Master::class
        ];
    }
}
