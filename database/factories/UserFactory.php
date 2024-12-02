<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'code' => fake()->optional()->word, // Optional, can be null
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->optional()->phoneNumber, // Optional, can be null
            'photo' => fake()->optional()->imageUrl(), // Optional, can be null
            'email_verified_at' => fake()->optional()->dateTime(), // Optional, can be null
            'password' => bcrypt('password'), // Use bcrypt for password hashing
            // 'staff_id' => fake()->numberBetween(1, 100), // Assuming staff_id is a foreign key
            'remember_token' => Str::random(10), // Generate a random string for remember token
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
