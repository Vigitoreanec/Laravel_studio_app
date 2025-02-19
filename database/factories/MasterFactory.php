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
        static $photoIndex = 0;
        $photos = glob(public_path('images/masters/*.{jpg,png,gif,webp,jpeg}'), GLOB_BRACE);
        // $randomPhoto = basename($photos[array_rand($photos)]);
        $photo = basename($photos[$photoIndex & count($photos)]);
        $photoIndex++;

        return [
            'name' => fake()->name(),
            //'description' => fake()->realTextBetween(100, 200),
            'description' => fake()->sentence(),
            'email' => $this->faker->unique()->userName . '@nailstudio.com',
            'image' => 'images/masters/' . $photo,
            //'image' => $this->faker->imageUrl(640, 480, 'people', true, true),
            //'password' => bcrypt('password'), // Пароль по умолчанию
        ];
    }
}
