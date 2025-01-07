<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\HeadOfDepartment;
use App\Models\HeadOfStudyProgram;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['id' => 5, 'code' => 'PL17.3.2', 'department' => 'Jurusan Teknologi Pertanian', 'user_id' => 2, 'created_at' => '2022-05-10 04:00:45', 'updated_at' => '2022-05-10 04:00:45'],
            ['id' => 6, 'code' => 'PL17.3.3', 'department' => 'Jurusan Peternakan', 'user_id' => 2, 'created_at' => '2022-05-10 04:03:21', 'updated_at' => '2022-05-10 04:03:21'],
            ['id' => 7, 'code' => 'PL17.3.4', 'department' => 'Jurusan Manajemen Agribisnis', 'user_id' => 2, 'created_at' => '2022-05-10 04:05:11', 'updated_at' => '2022-05-10 04:05:11'],
            ['id' => 8, 'code' => 'PL17.3.5', 'department' => 'Jurusan Teknologi Informasi', 'user_id' => 2, 'created_at' => '2022-05-10 04:05:41', 'updated_at' => '2022-05-10 04:05:41'],
            ['id' => 9, 'code' => 'PL17.3.6', 'department' => 'Jurusan Bahasa Komunikasi Dan Pariwisata', 'user_id' => 2, 'created_at' => '2022-05-10 04:18:43', 'updated_at' => '2022-05-10 04:18:43'],
            ['id' => 10, 'code' => 'PL17.3.7', 'department' => 'Jurusan Kesehatan', 'user_id' => 2, 'created_at' => '2022-05-10 04:19:08', 'updated_at' => '2022-05-10 04:19:08'],
            ['id' => 11, 'code' => 'PL17.3.8', 'department' => 'Jurusan Teknik', 'user_id' => 2, 'created_at' => '2022-05-10 04:19:31', 'updated_at' => '2022-05-10 04:19:31']
        ];

        DB::table('departments')->insert($departments);

        Department::factory(4)->create()->each(function($department) {
            HeadOfDepartment::factory(mt_rand(1, 3))->create([
                'department_id' => $department->id,
                'staff_id' => mt_rand(1, 10),
                'is_active' => fake()->boolean
            ]);
            StudyProgram::factory(mt_rand(3, 9))->create([
                'department_id' => $department->id,
                'user_id' => mt_rand(1, 10),
            ])->each(function($studyProgram) {
                HeadOfStudyProgram::factory(mt_rand(1, 3))->create([
                    'study_program_id' => $studyProgram->id,
                    'staff_id' => mt_rand(1, 10),
                    'is_active' => fake()->boolean,
                ]);
            });
        });
    }
}
