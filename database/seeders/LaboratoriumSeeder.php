<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratoriumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laboratories')->insert([
            ['code' => 'PL17.3.5.04', 'name' => 'Rekayasa Perangkat Lunak', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2022-08-20 17:35:42', 'updated_at' => '2022-09-30 08:19:35', 'acronym' => 'RPL', 'color' => '#2B908F'],
            ['code' => 'PL17.3.5.06', 'name' => 'Multimedia Cerdas', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2022-08-20 17:45:51', 'updated_at' => '2022-09-30 08:19:56', 'acronym' => 'MMC', 'color' => '#F9A3A4'],
            ['code' => 'PL17.3.5.01', 'name' => 'Komputasi Dan Sistem Informasi', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2022-09-30 08:24:34', 'updated_at' => '2022-09-30 08:27:56', 'acronym' => 'KSI', 'color' => '#90EE7E'],
            ['code' => 'PL17.3.5.02', 'name' => 'Sistem Komputer Dan Kontrol', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2022-09-30 08:25:13', 'updated_at' => '2022-09-30 08:25:13', 'acronym' => 'SKK', 'color' => '#FA4443'],
            ['code' => 'PL17.3.5.03', 'name' => 'Arsitektur Dan Jaringan Komputer', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2022-09-30 08:26:45', 'updated_at' => '2022-09-30 08:26:45', 'acronym' => 'AJK', 'color' => '#69D2E7'],
            ['code' => 'PL17.3.5.05', 'name' => 'Rekayasa Sistem Informasi', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2022-09-30 08:28:45', 'updated_at' => '2022-09-30 08:28:45', 'acronym' => 'RSI', 'color' => '#008FFB'],
            ['code' => 'PL17.3.5.04', 'name' => 'Rekayasa Perangkat Lunak - BWS', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2023-07-27 08:47:39', 'updated_at' => '2023-07-27 08:47:55', 'acronym' => null, 'color' => null],
            ['code' => 'PL17.3.5.03', 'name' => 'Administrasi Jaringan Komputer - BWS', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2023-07-27 08:48:57', 'updated_at' => '2023-07-27 08:49:16', 'acronym' => null, 'color' => null],
            ['code' => 'PL17.3.5.05', 'name' => 'Rekayasa Sistem Informasi - SDA', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2024-03-07 01:44:32', 'updated_at' => '2024-03-07 01:44:32', 'acronym' => null, 'color' => null],
            ['code' => 'PL17.3.5.02', 'name' => 'Sistem Komputer Dan Kontrol - SDA', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2024-03-07 01:58:04', 'updated_at' => '2024-03-07 01:58:04', 'acronym' => null, 'color' => null],
            ['code' => 'PL17.3.5.06', 'name' => 'Multimedia Cerdas - NJK', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2024-03-07 02:05:39', 'updated_at' => '2024-03-07 02:05:39', 'acronym' => null, 'color' => null],
            ['code' => 'PL17.3.5.01', 'name' => 'Komputasi Dan Sistem Informasi - NJK', 'department_id' => 8, 'user_id' => 1, 'created_at' => '2024-03-07 02:07:57', 'updated_at' => '2024-03-07 02:08:18', 'acronym' => null, 'color' => null],
        ]);
    }
}
