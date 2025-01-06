<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->boolean(), // Generates a random boolean value (true or false)
            'staff_status_id' => fake()->optional()->numberBetween(1, 3), // Generates a random number for foreign key, can be null
            'created_at' => now(), // Current timestamp for created_at
            'updated_at' => now(), // Current timestamp for updated_at
        ];
    }
}
