<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SemesterCourse>
 */
class SemesterCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'study_program_id' => $this->faker->numberBetween(1, 20),
            'semester_id' => $this->faker->numberBetween(1, 20),
            'course_id' => $this->faker->numberBetween(1, 20),
            'user_id' => 1,
            'total_group' => $this->faker->numberBetween(1, 10),
        ];
    }
}
