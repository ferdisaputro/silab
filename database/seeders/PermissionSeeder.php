<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('permissions')->truncate();

        $permissions = [
            ['name' => 'staff-list','guard_name' => 'web','created_at' => '2022-04-18 12:21:55','updated_at' => '2022-04-18 12:51:25'],
            ['name' => 'staff-create','guard_name' => 'web','created_at' => '2022-04-18 12:21:55','updated_at' => '2022-04-18 12:50:39'],
            ['name' => 'staff-edit','guard_name' => 'web','created_at' => '2022-04-18 12:21:55','updated_at' => '2022-04-18 12:21:55'],
            ['name' => 'staff-delete','guard_name' => 'web','created_at' => '2022-04-18 12:21:55','updated_at' => '2022-04-18 12:21:55'],
            ['name' => 'jurusan-list','guard_name' => 'web','created_at' => '2022-04-25 08:42:33','updated_at' => '2022-04-25 08:42:33'],
            ['name' => 'jurusan-create','guard_name' => 'web','created_at' => '2022-04-25 08:42:33','updated_at' => '2022-04-25 08:42:33'],
            ['name' => 'jurusan-edit','guard_name' => 'web','created_at' => '2022-04-25 08:42:33','updated_at' => '2022-04-25 08:42:33'],
            ['name' => 'jurusan-delete','guard_name' => 'web','created_at' => '2022-04-25 08:42:33','updated_at' => '2022-04-25 08:42:33'],
            ['name' => 'all-staff-list','guard_name' => 'web','created_at' => '2022-04-26 11:05:53','updated_at' => '2022-04-26 11:05:53'],
            ['name' => 'set-staff-role','guard_name' => 'web','created_at' => '2022-04-26 11:05:53','updated_at' => '2022-04-26 11:05:53'],
            ['name' => 'matakuliah-list','guard_name' => 'web','created_at' => '2022-04-26 12:29:08','updated_at' => '2022-04-26 12:29:08'],
            ['name' => 'matakuliah-create','guard_name' => 'web','created_at' => '2022-04-26 12:29:08','updated_at' => '2022-04-26 12:29:08'],
            ['name' => 'matakuliah-edit','guard_name' => 'web','created_at' => '2022-04-26 12:29:08','updated_at' => '2022-04-26 12:29:08'],
            ['name' => 'matakuliah-delete','guard_name' => 'web','created_at' => '2022-04-26 12:29:08','updated_at' => '2022-04-26 12:29:08'],
            ['name' => 'prodi-list','guard_name' => 'web','created_at' => '2022-05-01 16:19:01','updated_at' => '2022-05-01 16:19:01'],
            ['name' => 'prodi-create','guard_name' => 'web','created_at' => '2022-05-01 16:19:01','updated_at' => '2022-05-01 16:19:01'],
            ['name' => 'prodi-edit','guard_name' => 'web','created_at' => '2022-05-01 16:19:01','updated_at' => '2022-05-01 16:19:01'],
            ['name' => 'prodi-delete','guard_name' => 'web','created_at' => '2022-05-01 16:19:02','updated_at' => '2022-05-01 16:19:02'],
            ['name' => 'semester-list','guard_name' => 'web','created_at' => '2022-05-10 11:23:37','updated_at' => '2022-05-10 11:23:37'],
            ['name' => 'semester-create','guard_name' => 'web','created_at' => '2022-05-10 11:23:37','updated_at' => '2022-05-10 11:23:37'],
            ['name' => 'semester-edit','guard_name' => 'web','created_at' => '2022-05-10 11:23:37','updated_at' => '2022-05-10 11:23:37'],
            ['name' => 'semester-delete','guard_name' => 'web','created_at' => '2022-05-10 11:23:37','updated_at' => '2022-05-10 11:23:37'],
            ['name' => 'setmatakuliah-list','guard_name' => 'web','created_at' => '2022-05-12 09:55:57','updated_at' => '2022-05-12 09:55:57'],
            ['name' => 'setmatakuliah-create','guard_name' => 'web','created_at' => '2022-05-12 09:55:57','updated_at' => '2022-05-12 09:55:57'],
            ['name' => 'setpengampu-list','guard_name' => 'web','created_at' => '2022-05-12 12:35:57','updated_at' => '2022-05-12 12:35:57'],
            ['name' => 'setpengampu-create','guard_name' => 'web','created_at' => '2022-05-12 12:35:57','updated_at' => '2022-05-12 12:35:57'],
            ['name' => 'permission-list','guard_name' => 'web','created_at' => '2022-05-13 14:54:48','updated_at' => '2022-05-13 14:54:48'],
            ['name' => 'permission-create','guard_name' => 'web','created_at' => '2022-05-13 14:54:48','updated_at' => '2022-05-13 14:54:48'],
            ['name' => 'permission-edit','guard_name' => 'web','created_at' => '2022-05-13 14:54:48','updated_at' => '2022-05-13 14:54:48'],
            ['name' => 'permission-delete','guard_name' => 'web','created_at' => '2022-05-13 14:54:48','updated_at' => '2022-05-13 14:54:48'],
            ['name' => 'role-list','guard_name' => 'web','created_at' => '2022-05-13 14:54:48','updated_at' => '2022-05-13 14:54:48'],
            ['name' => 'role-create','guard_name' => 'web','created_at' => '2022-05-13 14:54:48','updated_at' => '2022-05-13 14:54:48'],
            ['name' => 'role-edit','guard_name' => 'web','created_at' => '2022-05-13 14:54:48','updated_at' => '2022-05-13 14:54:48'],
            ['name' => 'role-delete','guard_name' => 'web','created_at' => '2022-05-13 14:54:48','updated_at' => '2022-05-13 14:54:48'],
            ['name' => 'pengajuan-alat-bahan-list','guard_name' => 'web','created_at' => '2022-05-17 18:18:33','updated_at' => '2022-06-17 12:47:18'],
            ['name' => 'tahunajaran-list','guard_name' => 'web','created_at' => '2022-05-31 11:00:18','updated_at' => '2022-05-31 11:00:18'],
            ['name' => 'tahunajaran-create','guard_name' => 'web','created_at' => '2022-05-31 11:00:18','updated_at' => '2022-05-31 11:00:18'],
            ['name' => 'tahunajaran-edit','guard_name' => 'web','created_at' => '2022-05-31 11:00:18','updated_at' => '2022-05-31 11:00:18'],
            ['name' => 'tahunajaran-delete','guard_name' => 'web','created_at' => '2022-05-31 11:00:18','updated_at' => '2022-05-31 11:00:18'],
            ['name' => 'minggu-list','guard_name' => 'web','created_at' => '2022-06-01 15:20:55','updated_at' => '2022-06-01 15:20:55'],
            ['name' => 'minggu-create','guard_name' => 'web','created_at' => '2022-06-01 15:20:55','updated_at' => '2022-06-01 15:20:55'],
            ['name' => 'minggu-edit','guard_name' => 'web','created_at' => '2022-06-01 15:20:56','updated_at' => '2022-06-01 15:20:56'],
            ['name' => 'minggu-delete','guard_name' => 'web','created_at' => '2022-06-01 15:20:56','updated_at' => '2022-06-01 15:20:56'],
            ['name' => 'pengajuan-alat-bahan-create','guard_name' => 'web','created_at' => '2022-06-17 10:24:14','updated_at' => '2022-06-17 10:24:14'],
            ['name' => 'pengajuan-alat-bahan-edit','guard_name' => 'web','created_at' => '2022-06-17 10:24:14','updated_at' => '2022-06-17 10:24:14'],
            ['name' => 'pengajuan-alat-bahan-delete','guard_name' => 'web','created_at' => '2022-06-17 10:24:15','updated_at' => '2022-06-17 10:24:15'],
            ['name' => 'satuan-list','guard_name' => 'web','created_at' => '2022-06-20 11:20:01','updated_at' => '2022-06-20 11:20:01'],
            ['name' => 'satuan-create','guard_name' => 'web','created_at' => '2022-06-20 11:20:01','updated_at' => '2022-06-20 11:20:01'],
            ['name' => 'satuan-edit','guard_name' => 'web','created_at' => '2022-06-20 11:20:01','updated_at' => '2022-06-20 11:20:01'],
            ['name' => 'satuan-delete','guard_name' => 'web','created_at' => '2022-06-20 11:20:01','updated_at' => '2022-06-20 11:20:01'],
            ['name' => 'barang-list','guard_name' => 'web','created_at' => '2022-06-22 09:54:26','updated_at' => '2022-06-22 09:54:26'],
            ['name' => 'barang-create','guard_name' => 'web','created_at' => '2022-06-22 09:54:26','updated_at' => '2022-06-22 09:54:26'],
            ['name' => 'barang-edit','guard_name' => 'web','created_at' => '2022-06-22 09:54:26','updated_at' => '2022-06-22 09:54:26'],
            ['name' => 'barang-delete','guard_name' => 'web','created_at' => '2022-06-22 09:54:26','updated_at' => '2022-06-22 09:54:26'],
            ['name' => 'review-pangajuan-alat-edit','guard_name' => 'web','created_at' => '2022-08-11 22:13:58','updated_at' => '2022-08-11 22:22:52'],
            ['name' => 'review-pangajuan-alat-cetak','guard_name' => 'web','created_at' => '2022-08-11 22:14:41','updated_at' => '2022-08-11 22:14:41'],
            ['name' => 'review-pangajuan-alat-list','guard_name' => 'web','created_at' => '2022-08-11 22:21:28','updated_at' => '2022-08-11 22:21:28'],
            ['name' => 'review-pangajuan-alat-show','guard_name' => 'web','created_at' => '2022-08-18 01:05:57','updated_at' => '2022-08-18 01:05:57'],
            ['name' => 'penggantian-praktek-create','guard_name' => 'web','created_at' => '2022-08-19 16:03:55','updated_at' => '2022-08-19 16:03:55'],
            ['name' => 'lab-list','guard_name' => 'web','created_at' => '2022-08-21 00:14:04','updated_at' => '2022-08-21 00:14:04'],
            ['name' => 'lab-edit','guard_name' => 'web','created_at' => '2022-08-21 00:14:05','updated_at' => '2022-08-21 00:14:05'],
            ['name' => 'lab-create','guard_name' => 'web','created_at' => '2022-08-21 00:14:05','updated_at' => '2022-08-21 00:14:05'],
            ['name' => 'lab-delete','guard_name' => 'web','created_at' => '2022-08-21 00:14:05','updated_at' => '2022-08-21 00:14:05'],
            ['name' => 'memberlab-create','guard_name' => 'web','created_at' => '2022-08-21 02:20:42','updated_at' => '2022-08-21 02:20:42'],
            ['name' => 'deliver-pangajuan-alat-list','guard_name' => 'web','created_at' => '2022-08-21 21:43:42','updated_at' => '2022-08-21 21:43:42'],
            ['name' => 'stok-in-pengadaan-list','guard_name' => 'web','created_at' => '2022-08-23 00:02:36','updated_at' => '2022-08-23 00:04:01'],
            ['name' => 'stok-in-pengadaan-edit','guard_name' => 'web','created_at' => '2022-08-23 00:49:39','updated_at' => '2022-08-23 00:49:39'],
            ['name' => 'inventaris-bahan-list','guard_name' => 'web','created_at' => '2022-08-24 02:08:01','updated_at' => '2022-08-24 02:08:01'],
            ['name' => 'inventaris-bahan-cetak','guard_name' => 'web','created_at' => '2022-08-24 02:08:24','updated_at' => '2022-08-24 02:08:24'],
            ['name' => 'inventaris-kartu-stok','guard_name' => 'web','created_at' => '2022-08-24 02:09:03','updated_at' => '2022-08-24 02:09:03'],
            ['name' => 'penggantian-praktek-list','guard_name' => 'web','created_at' => '2022-08-24 12:21:57','updated_at' => '2022-09-12 16:43:51'],
            ['name' => 'kesiapan-praktek-list','guard_name' => 'web','created_at' => '2022-08-25 19:55:35','updated_at' => '2022-08-25 19:55:35'],
            ['name' => 'kesiapan-praktek-create','guard_name' => 'web','created_at' => '2022-08-25 19:55:37','updated_at' => '2022-08-25 19:55:37'],
            ['name' => 'kesiapan-praktek-edit','guard_name' => 'web','created_at' => '2022-08-25 19:55:39','updated_at' => '2022-08-25 19:55:39'],
            ['name' => 'kesiapan-praktek-delete','guard_name' => 'web','created_at' => '2022-08-25 19:55:41','updated_at' => '2022-08-25 19:55:41'],
            ['name' => 'bonalat-list','guard_name' => 'web','created_at' => '2022-08-28 01:31:06','updated_at' => '2022-08-28 01:31:09'],
            ['name' => 'bonalat-edit','guard_name' => 'web','created_at' => '2022-08-28 01:31:19','updated_at' => '2022-08-28 01:31:20'],
            ['name' => 'bonalat-create','guard_name' => 'web','created_at' => '2022-08-28 01:31:37','updated_at' => '2022-08-28 01:31:37'],
            ['name' => 'bonalat-delete','guard_name' => 'web','created_at' => '2022-08-28 01:31:51','updated_at' => '2022-08-28 01:31:51'],
            ['name' => 'inventaris-alat-list','guard_name' => 'web','created_at' => '2022-08-29 02:18:33','updated_at' => '2022-08-29 02:18:34'],
            ['name' => 'inventaris-alat-create','guard_name' => 'web','created_at' => '2022-08-29 02:18:49','updated_at' => '2022-08-29 02:18:50'],
            ['name' => 'inventaris-alat-edit','guard_name' => 'web','created_at' => '2022-08-29 02:19:03','updated_at' => '2022-08-29 02:19:04'],
            ['name' => 'inventaris-alat-delete','guard_name' => 'web','created_at' => '2022-08-29 02:19:19','updated_at' => '2022-08-29 02:19:20'],
            ['name' => 'penggantian-praktek-delete','guard_name' => 'web','created_at' => '2022-09-12 16:47:07','updated_at' => '2022-09-12 16:47:07'],
            ['name' => 'penggantian-praktek-edit','guard_name' => 'web','created_at' => '2022-09-12 16:47:07','updated_at' => '2022-09-12 16:47:07'],
            ['name' => 'kehilangan-list','guard_name' => 'web','created_at' => '2022-09-13 13:22:16','updated_at' => '2022-09-13 13:22:16'],
            ['name' => 'kehilangan-create','guard_name' => 'web','created_at' => '2022-09-13 13:22:19','updated_at' => '2022-09-13 13:22:19'],
            ['name' => 'kehilangan-edit','guard_name' => 'web','created_at' => '2022-09-13 13:22:20','updated_at' => '2022-09-13 13:22:20'],
            ['name' => 'kehilangan-delete','guard_name' => 'web','created_at' => '2022-09-13 13:22:22','updated_at' => '2022-09-13 13:22:22'],
            ['name' => 'serma-list','guard_name' => 'web','created_at' => '2022-09-14 21:07:20','updated_at' => '2022-09-14 21:07:20'],
            ['name' => 'serma-edit','guard_name' => 'web','created_at' => '2022-09-14 21:07:21','updated_at' => '2022-09-14 21:07:21'],
            ['name' => 'serma-create','guard_name' => 'web','created_at' => '2022-09-14 21:07:21','updated_at' => '2022-09-14 21:07:21'],
            ['name' => 'serma-delete','guard_name' => 'web','created_at' => '2022-09-14 21:07:21','updated_at' => '2022-09-14 21:07:21'],
            ['name' => 'ijinLBS-list','guard_name' => 'web','created_at' => '2022-09-20 15:46:33','updated_at' => '2022-09-20 15:46:33'],
            ['name' => 'ijinLBS-create','guard_name' => 'web','created_at' => '2022-09-20 15:46:44','updated_at' => '2022-09-20 15:46:44'],
            ['name' => 'ijinLBS-edit','guard_name' => 'web','created_at' => '2022-09-20 15:46:52','updated_at' => '2022-09-20 15:46:52'],
            ['name' => 'ijinLBS-delete','guard_name' => 'web','created_at' => '2022-09-20 15:47:00','updated_at' => '2022-09-20 15:47:01'],
            ['name' => 'inventaris-bahan-create','guard_name' => 'web','created_at' => '2022-10-02 22:58:23','updated_at' => '2022-10-02 22:58:23'],
            ['name' => 'inventaris-bahan-edit','guard_name' => 'web','created_at' => '2022-10-02 22:58:25','updated_at' => '2022-10-02 22:58:25'],
            ['name' => 'dashboard-all-lab','guard_name' => 'web','created_at' => '2022-10-09 18:31:27','updated_at' => '2022-10-09 18:31:27'],
            ['name' => 'dashboard-lab','guard_name' => 'web','created_at' => '2022-10-10 08:52:08','updated_at' => '2022-10-10 08:52:08']
        ];

        DB::table('permissions')->insert($permissions);
    }
}
