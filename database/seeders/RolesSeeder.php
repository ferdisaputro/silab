<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Administrator', 'guard_name' => 'web', 'created_at' => '2022-04-17 23:05:58', 'updated_at' => '2022-04-17 23:05:58'],
            ['name' => 'Koordinator Matakuliah', 'guard_name' => 'web', 'created_at' => '2022-05-13 09:35:01', 'updated_at' => '2022-05-13 09:35:01'],
            ['name' => 'Tim Pengadaan', 'guard_name' => 'web', 'created_at' => '2022-08-11 22:16:27', 'updated_at' => '2022-08-11 22:16:27'],
            ['name' => 'Teknisi', 'guard_name' => 'web', 'created_at' => '2022-08-19 16:02:51', 'updated_at' => '2022-08-19 16:02:51'],
            ['name' => 'Teknisi & Tim Pengadaan', 'guard_name' => 'web', 'created_at' => '2022-09-30 16:14:57', 'updated_at' => '2022-09-30 16:14:57'],
            ['name' => 'Manajemen Jurusan', 'guard_name' => 'web', 'created_at' => '2022-10-10 08:40:30', 'updated_at' => '2022-10-10 10:13:46'],
            ['name' => 'Kepala Laboratorium', 'guard_name' => 'web', 'created_at' => '2022-10-10 09:02:30', 'updated_at' => '2022-10-10 09:02:30']
        ]);
    }
}
