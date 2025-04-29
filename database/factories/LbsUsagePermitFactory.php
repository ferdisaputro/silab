<?php

namespace Database\Factories;

use App\Models\LbsUsagePermit;
use Illuminate\Database\Eloquent\Factories\Factory;

class LbsUsagePermitFactory extends Factory
{
    /**
     * Nama model yang di-factory-kan.
     */
    protected $model = LbsUsagePermit::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->bothify('LBS-########'),
            'is_staff' => $this->faker->boolean,
            'name' => $this->faker->name,
            'nim' => $this->faker->numerify('##########'),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement([1, 2]),

            'staff_id' => null,
            'staff_id_mentor' => null,
            'study_program_id' => null,
            'laboratory_id' => $this->faker->numberBetween(1,12),
            'lab_member_id' => null,
        ];
    }
}
