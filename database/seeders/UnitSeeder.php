<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::insert([
            ['satuan' => 'rim', 'user_id' => '1' , 'created_at' => now(), 'updated_at' => now()],
            ['satuan' => 'pcs', 'user_id' => '1' , 'created_at' => now(), 'updated_at' => now()],
            ['satuan' => 'dus', 'user_id' => '1' , 'created_at' => now(), 'updated_at' => now()],
            ['satuan' => 'pack', 'user_id' => '1' , 'created_at' => now(), 'updated_at' => now()],
            ['satuan' => 'meter', 'user_id' => '1' , 'created_at' => now(), 'updated_at' => now()],
        ]);
        // Unit::factory()->count(100)->create(); // Membuat 10 data unit
    }
}
