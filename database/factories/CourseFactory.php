<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->regexify('[A-Z]{3}[0-9]{3}'),
            'course' => fake()->sentence,
            'is_active' => mt_rand(0, 1),
            'user_id' => fake()->numberBetween(1, 4)
        ];
    }
}
