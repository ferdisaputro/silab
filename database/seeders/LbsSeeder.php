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
        LbsUsagePermit::factory(10)->create()->each(function($lbsusage) {
            LbsUsagePermitDetail::factory(mt_rand(1, 10))->create([
                'lbs_usage_permit_id' => $lbsusage->id
            ]);
        });
    }
}
