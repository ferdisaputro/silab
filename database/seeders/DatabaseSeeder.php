<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Staff;
use App\Models\StaffStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StaffStatus::create([
            'staff_status' => 'Administrasi'
        ]);
        StaffStatus::create([
            'staff_status' => 'Dosen'
        ]);
        StaffStatus::create([
            'staff_status' => 'Teknisi'
        ]);


        Staff::factory(50)->create()->each(function($staff) {
            User::factory()->create([
                'staff_id' => $staff->id,
            ]);
        });
    }
}
