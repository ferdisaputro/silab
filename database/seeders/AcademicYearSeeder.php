<?php

namespace Database\Seeders;

use App\Models\Semester;
use App\Models\AcademicWeek;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicYears = [
            ['start_year' => 2020, 'end_year' => 2021, 'is_even' => 1, 'is_active' => 1, 'created_at' => '2022-07-03 07:39:03', 'updated_at' => '2022-10-04 06:03:37'],
            ['start_year' => 2020, 'end_year' => 2021, 'is_even' => 0, 'is_active' => 0, 'created_at' => '2022-05-31 04:33:26', 'updated_at' => '2022-10-04 06:11:43'],
            ['start_year' => 2022, 'end_year' => 2023, 'is_even' => 1, 'is_active' => 1, 'created_at' => '2022-05-31 04:33:38', 'updated_at' => '2022-10-04 06:12:24'],
            ['start_year' => 2022, 'end_year' => 2023, 'is_even' => 0, 'is_active' => 0, 'created_at' => '2022-07-03 07:42:45', 'updated_at' => '2024-06-13 02:27:15'],
            ['start_year' => 2024, 'end_year' => 2025, 'is_even' => 1, 'is_active' => 1, 'created_at' => '2024-06-13 06:14:16', 'updated_at' => '2024-06-13 06:14:18'],
        ];

        DB::table('academic_years')->insert($academicYears);

        foreach ($academicYears as $academicYear) {
            $academicYearData = DB::table('academic_years')
                ->where('start_year', $academicYear['start_year'])
                ->where('end_year', $academicYear['end_year'])
                ->where('is_even', $academicYear['is_even'])
                ->where('is_active', $academicYear['is_active'])
                ->first();

            for ($weekNumber = 1; $weekNumber <= 16; $weekNumber++) {
                $semester = 0;
                AcademicWeek::factory()->create([
                    'academic_year_id' => $academicYearData->id,
                    'week_number' => $weekNumber,
                ]);
            }
            for ($i=1; $i <= 8; $i += 2) {
                Semester::create([
                    'semester' => $i + $academicYearData->is_even,
                    'is_even' => $academicYearData->is_even,
                    'user_id' => 1,
                    'academic_year_id' => $academicYearData->id
                ]);
            }
        }
    }
}
