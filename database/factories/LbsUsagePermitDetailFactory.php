<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\LbsUsagePermitDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class LbsUsagePermitDetailFactory extends Factory
{
    protected $model = LbsUsagePermitDetail::class;

    public function definition(): array
    {
        return [
            // 'code'=>$this->faker->word,
            'qty'=>$this->faker->numberBetween(1,100),
            'return_qty'=>$this->faker->numberBetween(0,100),
            'description'=>$this->faker->sentence,
            'status'=>$this->faker->randomElement([1,2]),
            // 'lbs_usage_permit_id'
            'lab_item_id'=>mt_rand(1,10),
            'stock_card_id'=>null,
            'stock_card_id_return'=>null
        ];
    }
}
