<?php

namespace Database\Seeders;

use App\Models\ItemType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class item_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemType::insert([
            ['item_type' => 'Alat', 'created_at' => now(), 'updated_at' => now()],
            ['item_type' => 'Bahan', 'created_at' => now(), 'updated_at' => now()],
            ['item_type' => 'Hasil Praktek', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
