<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Master;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'datetime' => $this->faker->dateTimeBetween('now', '+1 month'),
            'client_id' => Client::inRandomOrder()->first()->id,
            'master_id' => Master::inRandomOrder()->first()->id,
            'service_id' => Service::inRandomOrder()->first()->id
        ];
    }
}
