<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LabItem>
 */
class LabItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->regexify('[A-Z]{2}[0-9]{8}'),
            'description' => $this->faker->text,
            'stock' => $this->faker->numberBetween(1, 50),
            'laboratory_id' => $this->faker->numberBetween(1, 7),
            'item_id' => $this->faker->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
