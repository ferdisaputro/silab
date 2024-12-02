<?php

namespace Database\Seeders;

use App\Models\StaffStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // StaffStatus::truncate();

        StaffStatus::create([
            'staff_status' => 'Dosen'
        ]);
        StaffStatus::create([
            'staff_status' => 'Administrasi'
        ]);
        StaffStatus::create([
            'staff_status' => 'Teknisi'
        ]);
    }
}
