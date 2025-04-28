<?php

namespace Database\Seeders;

use App\Models\SemesterCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SemesterCourse::factory()->count(15)->create();
    }
}
