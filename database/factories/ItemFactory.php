<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name' => $this->faker->word(),
            'item_code' => $this->faker->word(),
            'quantity' => mt_rand(1, 50),
            'specification' => $this->faker->sentence(),
            'description' => $this->faker->sentence(),
            'user_id' => mt_rand(1, 5),
            'unit_id' => mt_rand(1, 9),
            'item_type_id' => mt_rand(1, 3),
        ];
    }
}
