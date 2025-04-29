<?php

// database/seeders/LbsUsagePermitSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LbsUsagePermit;
use App\Models\LbsUsagePermitDetail;

class LbsSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 data permit utama
        LbsUsagePermit::factory()->count(30)->create();
    }
}
