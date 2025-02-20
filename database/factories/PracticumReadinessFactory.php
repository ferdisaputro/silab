<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PracticumReadiness>
 */
class PracticumReadinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'recomendation' => $this->faker->numberBetween(1, 4), // 1-4 sesuai komentar
            'date' => $this->faker->date(), // Tanggal acak
            'course_instructor_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
            'semester_course_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
            'staff_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
            'lab_member_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
            'laboratory_id' => $this->faker->numberBetween(1, 12), // Range ID 1-15
            'academic_week_id' => $this->faker->numberBetween(1, 15), // Range ID 1-15
        ];
    }
}
