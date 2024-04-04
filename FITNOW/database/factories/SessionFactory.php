<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100), 
            'name' => $this->faker->word,
            'weight' => $this->faker->randomFloat(2, 50, 200), 
            'chest' => $this->faker->randomFloat(2, 30, 100),
            'waist' => $this->faker->randomFloat(2, 20, 80), 
            'status' => $this->faker->randomElement(['non terminer', 'terminer']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
