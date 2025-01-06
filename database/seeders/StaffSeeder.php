<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::truncate();
        // Staff::truncate();

        DB::table('users')->delete();
        DB::table('staff')->delete();

        User::factory(50)->create()->each(function($user) {
            Staff::factory()->create([
                'user_id' => $user->id
            ]);
        });
    }
}
