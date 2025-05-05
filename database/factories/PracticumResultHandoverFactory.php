<?php

namespace Database\Factories;

use App\Models\PracticumResultHandover;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PracticumResultHandover>
 */
class PracticumResultHandoverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PracticumResultHandover::class;
    public function definition(): array
    {
        return [
            'code' => $this->faker->bothify('PRL-########'),
            'practicum_event' => $this->faker->word,
            'date' => $this->faker->date(),

            // Menetapkan nilai laboratory_id hanya 5 atau 7
            'laboratory_id' => $this->faker->numberBetween(1,12),

            // Foreign Keys
            'course_instructor_id' => $this->faker->numberBetween(1,10),
            'academic_week_id' => $this->faker->numberBetween(1,20),
            'lab_member_id' => 1,
        ];
    }
}
