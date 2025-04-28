<?php

namespace Database\Factories;

use App\Models\ItemLossOrDamage;
use App\Models\ItemLossOrDamageDetail;
use App\Models\LabItem;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemLossOrDamageDetail>
 */
class ItemLossOrDamageDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = ItemLossOrDamageDetail::class;

     public function definition()
    {
        return [
            'code' => $this->faker->unique()->numerify('LDD######'),
            'amount_loss_damaged' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement([1, 2, 3]),
            'item_loss_or_damage_id' => ItemLossOrDamage::factory(),
            'lab_item_id' => LabItem::factory(),
        ];
    }
}
