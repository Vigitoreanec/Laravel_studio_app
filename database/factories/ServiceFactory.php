<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Master;
use Database\Seeders\CategoriesTableSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(0, 1500, 3500),
            'category_id' => Category::inRandomOrder()->first()->id,
            'master_id' => Master::inRandomOrder()->first()->id
        ];
    }
}
