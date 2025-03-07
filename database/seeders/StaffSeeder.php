<?php

namespace Database\Seeders;

use Illuminate;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
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

        // DB::table('users')->delete();
        // DB::table('staff')->delete();

        $defaultUser = User::create([
            'name' => 'Admin',
            'code' => Str::random(4),
            'phone' => fake()->phoneNumber, // Optional, can be null
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        Staff::create([
            'user_id' => $defaultUser->id,
            'status' => 1,
            'staff_status_id' => 1,
        ]);
        $teknisi = User::create([
            'name' => 'Teknisi',
            'code' => Str::random(4),
            'phone' => fake()->phoneNumber, // Optional, can be null
            'email' => 'teknisi@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        Staff::create([
            'user_id' => $teknisi->id,
            'status' => 1,
            'staff_status_id' => 3,
        ]);

        $defaultUser->assignRole(Role::find(1));
        $teknisi->assignRole(Role::find(1));

        User::factory(20)->create()->each(function($user) {
            Staff::factory(1)->create([
                'user_id' => $user->id
            ]);
        });
    }
}
