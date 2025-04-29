<?php

namespace Database\Factories;

use App\Models\LbsUsagePermitDetail;
use App\Models\LbsUsagePermit;
use Illuminate\Database\Eloquent\Factories\Factory;

class LbsUsagePermitDetailFactory extends Factory
{
    protected $model = LbsUsagePermitDetail::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->bothify('DET-#######'),
            'qty' => $this->faker->numberBetween(1, 10),

            // Pastikan kamu punya data terkait atau set null dulu jika belum
            'lbs_usage_permit_id' => LbsUsagePermit::inRandomOrder()->first()?->id ?? LbsUsagePermit::factory(),
            'lab_item_id' => 1, // Ganti sesuai ID yang tersedia atau pakai factory jika kamu sudah buat
            'unit_id' => null,
            'stock_card_id' => null,
            'laboratory_id' => $this->faker->numberBetween(1,12)
        ];
    }
}
