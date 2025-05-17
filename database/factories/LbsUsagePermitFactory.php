<?php

namespace Database\Factories;

use App\Models\LbsUsagePermit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LbsUsagePermitFactory extends Factory
{
    /**
     * Nama model yang di-factory-kan.
     */
    protected $model = LbsUsagePermit::class;

    public function definition(): array
    {
        return [
            'code' => Str::random(8),
            'staff_id' => mt_rand(1, 10),
            'is_staff' => $this->faker->boolean,
            'start_date' => $this->faker->date,
            'name' => $this->faker->name,
            'nim' => $this->faker->randomNumber(8),
            'group_class' => $this->faker->randomLetter('a', 'e'),
            'staff_id_returner' => mt_rand(1, 10),
            'is_returner_staff' => $this->faker->boolean,
            'end_date' => $this->faker->date,
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
