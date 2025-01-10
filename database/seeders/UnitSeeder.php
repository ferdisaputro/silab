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
        Unit::create([
            'satuan' => 'Lembar',
            'user_id' => 1
        ]);

        Unit::create([
            'satuan' => 'Rim',
            'user_id' => 1
        ]);

        Unit::create([
            'satuan' => 'Dus',
            'user_id' => 1
        ]);

        Unit::create([
            'satuan' => 'pcs',
            'user_id' => 1
        ]);

        Unit::create([
            'satuan' => 'pack',
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
            'satuan' => 'Meter',
            'user_id' => 1
        ]);

        Unit::create([
            'satuan' => 'Bendel',
            'user_id' => 1
        ]);
    }
}
