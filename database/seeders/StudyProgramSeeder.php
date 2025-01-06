<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [3,'PL17.3.5.1','Manajemen Informatika',8,1,'2022-05-10 04:20:48','2022-05-10 04:20:48'],
            [4,'PL17.3.5.2','Teknik Komputer',8,1,'2022-05-10 04:21:06','2022-05-10 04:21:06'],
            [5,'PL17.3.5.3','Teknik Informatika',8,1,'2022-05-10 04:21:49','2022-05-10 04:21:49'],
            [8,'PL17.3.5.4','Teknik Komputer WXIT',8,1,'2022-09-03 12:07:38','2022-09-03 12:07:38'],
            [9,'PL17.3.5.5','Manajemen Informatika - Internasional',8,1,'2022-09-03 12:09:32','2022-09-03 12:09:32'],
            [10,'PL17.3.5.6','Teknik Informatika - Internasional',8,1,'2022-09-03 12:10:17','2022-09-03 12:10:17'],
            [11,'PL17.3.5.7','Teknik Informatika - Bondowoso',8,1,'2022-09-03 12:11:20','2022-09-03 12:11:20'],
            [12,'PL17.3.5.8','Teknik Informatika - PSDKU Nganjuk',8,1,'2022-09-03 12:12:27','2022-09-03 12:12:27'],
            [13,'PL17.3.5.9','Teknik Informatika - PSDKU Sidoarjo',8,1,'2022-09-03 12:13:14','2022-09-03 12:13:14'],
            [14,'PL17.3.5.10','Teknik Informatika - Program Lintas Jenjang [PLJ)',8,1,'2022-09-03 12:14:07','2022-09-03 12:14:07'],
            [15,'PL17.3.5.11','Bisnis Digital',8,1,'2022-09-03 12:15:38','2022-09-03 12:15:38']
        ];

        StudyProgram::insert($data);
    }
}
