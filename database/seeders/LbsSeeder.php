<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LbsUsagePermit; // ini yang dipanggil, MODEL-nya

class LbsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ini baru benar
        LbsUsagePermit::factory()->count(10)->create();
    }
}
