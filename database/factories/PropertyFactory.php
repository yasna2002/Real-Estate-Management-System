<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'type' => $this->faker->word,
            'status' => $this->faker->word,
            'location' => $this->faker->address,
            'city' => $this->faker->city,
            'size' => $this->faker->randomFloat(2, 20, 500),
            'rooms' => $this->faker->numberBetween(1, 10),
        ];
    }
}
