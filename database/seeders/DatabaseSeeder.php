<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Staff;
use App\Models\StaffStatus;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

use App\Models\ItemLossOrDamage;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::table('staff')->delete();
        // DB::table('users')->delete();

        $this->call([
            StaffStatusesSeeder::class,
            PermissionSeeder::class,
            StaffSeeder::class,
            DepartmentSeeder::class,
            AcademicYearSeeder::class,
            CourseSeeder::class,
            LaboratoriumSeeder::class,
            ItemSeeder::class,
            // EquipmentLoanSeeder::class,
            // SemesterCourseSeeder::class,
            // CourseInstructorSeeder::class,
            // PracticumReadinessSeeder::class,
            // ItemLossOrDamageSeeder::class,
            // LbsSeeder::class,
        ]);
    }
}
