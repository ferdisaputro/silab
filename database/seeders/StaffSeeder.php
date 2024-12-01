<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::truncate();
        User::truncate();

        Staff::factory(50)->create()->each(function($staff) {
            User::factory()->create([
                'staff_id' => $staff->id,
            ]);
        });
    }
}
