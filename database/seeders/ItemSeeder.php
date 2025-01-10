<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\LabItem;
use App\Models\ItemType;
use App\Models\LabItemDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UnitSeeder::class
        ]);

        ItemType::create([
            'item_type' => 'Alat',
        ]);
        ItemType::create([
            'item_type' => 'Bahan',
        ]);
        ItemType::create([
            'item_type' => 'Hasil Praktek',
        ]);

        Item::factory(20)->create()->each(function($item) {
            $labItem = LabItem::factory()->create();
        });
    }
}
