<?php

namespace Database\Seeders;

use App\Models\ItemLossOrDamage;
use App\Models\ItemLossOrDamageDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemLossOrDamageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // PracticumReadiness::factory()->count(15)->create();
    ItemLossOrDamage::factory()->count(15)->create();
    // ->has(ItemLossOrDamageDetail::factory()->count(3), 'itemLossOrDamageDetails')
    // ->create();
    }
}
