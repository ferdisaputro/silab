<?php

namespace Database\Seeders;

use App\Models\CourseInstructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class courseInstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseInstructor::factory()->count(10)->create();
    }
}
