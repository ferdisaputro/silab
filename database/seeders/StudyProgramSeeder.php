<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studyPrograms = [
            ['code' => 'PL17.3.5.1', 'study_program' => 'Manajemen Informatika', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.2', 'study_program' => 'Teknik Komputer', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.3', 'study_program' => 'Teknik Informatika', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.4', 'study_program' => 'Teknik Komputer WXIT', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.5', 'study_program' => 'Manajemen Informatika - Internasional', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.6', 'study_program' => 'Teknik Informatika - Internasional', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.7', 'study_program' => 'Teknik Informatika - Bondowoso', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.8', 'study_program' => 'Teknik Informatika - PSDKU Nganjuk', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.9', 'study_program' => 'Teknik Informatika - PSDKU Sidoarjo', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.10', 'study_program' => 'Teknik Informatika - Program Lintas Jenjang (PLJ)', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'PL17.3.5.11', 'study_program' => 'Bisnis Digital', 'department_id' => 8, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('study_programs')->insert($studyPrograms);
    }
}
