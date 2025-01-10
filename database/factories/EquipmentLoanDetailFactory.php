<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentLoanDetail>
 */
class EquipmentLoanDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'code' => $this->faker->word,
            'qty' => $this->faker->numberBetween(1, 100),
            'return_qty' => $this->faker->numberBetween(0, 100),
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement([1, 2]),
            'lab_item_id' => mt_rand(1, 10),
            // 'stock_card_id' => mt_rand(1, 10),
            'stock_card_id' => null,
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => $this->faker->dateTimeThisYear
        ];
    }
}
