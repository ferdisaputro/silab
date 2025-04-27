<?php

namespace Database\Factories;

use App\Models\ItemLossOrDamage;
use App\Models\LabMember;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemLossOrDamage>
 */
class ItemLossOrDamageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ItemLossOrDamage::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->numerify('LD######'),
            'name' => $this->faker->name,
            'nim' => $this->faker->numerify('##########'),
            'group_class' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'status' => $this->faker->randomElement([1, 2, 3]),
            'date_replace_agreement' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'laboratory_id' => $this->faker->numberBetween(1,10),
            'lab_member_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
