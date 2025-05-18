<?php

namespace Database\Factories;

use App\Models\SemesterCourse;
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
    protected $model = SemesterCourse::class;
    public function definition(): array
    {
        return [
            'study_program_id' => $this->faker->numberBetween(1, 11), // Range ID 1-15
            'semester_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
            'course_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
            'user_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
            'total_group' => $this->faker->numberBetween(1, 10), // Angka acak antara 1-10
        ];
    }
}
