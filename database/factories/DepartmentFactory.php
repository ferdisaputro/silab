<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->regexify('[A-Z]{2}[0-9]{2}\.[0-9]{1}\.[0-9]{1}'), 
            'department' => $this->faker->sentence(5), 
            'user_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
