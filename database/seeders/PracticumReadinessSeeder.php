<?php

namespace Database\Seeders;

use App\Models\PracticumReadiness;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PracticumReadinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PracticumReadiness::factory()->count(15)->create();
    }
}
