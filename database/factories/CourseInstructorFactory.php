<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseInstructor>
 */
class CourseInstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'semester_course_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
            'staff_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
            'user_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
        ];
    }
}
