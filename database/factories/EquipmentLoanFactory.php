<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentLoan>
 */
class EquipmentLoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => Str::random(8),
            'staff_id' => mt_rand(1, 10),
            'is_staff' => $this->faker->boolean,
            'borrowing_date' => $this->faker->date,
            'name' => $this->faker->name,
            'nim' => $this->faker->randomNumber(8),
            'group_class' => $this->faker->randomLetter('a', 'e'),
            'staff_id_returner' => mt_rand(1, 10),
            'is_returner_staff' => $this->faker->boolean,
            'return_date' => $this->faker->date,
            'returner_name' => $this->faker->name,
            'returner_nim' => $this->faker->randomNumber(8),
            'returner_group_class' => $this->faker->word,
            'status' => $this->faker->randomElement([1, 2]),
            'laboratory_id' => mt_rand(1, 10),
            'lab_member_id_borrow' => mt_rand(1, 10),
            'lab_member_id_return' => mt_rand(1, 10),
            'staff_id_mentor' => mt_rand(1, 10),
        ];
    }
}
