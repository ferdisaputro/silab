<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
        Unit::create([
            'satuan' => 'Lembar',
            'user_id' => 1
        ]);

        Unit::create([
            'satuan' => 'unit',
            'user_id' => 1
        ]);

        Unit::create([
            'satuan' => 'buah',
            'user_id' => 1
        ]);

        Unit::create([
            'satuan' => 'Bendel',
            'user_id' => 1
        ]);
    }
}
