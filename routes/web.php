<?php

use App\Livewire\Pages\Homepage;
use App\Livewire\Pages\Role\Edit;
use App\Livewire\Pages\Role\Index;
use App\Livewire\Pages\Role\Create;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Item\Index as ItemIndex;
use App\Livewire\Pages\Unit\Index as UnitIndex;
use App\Livewire\Pages\Item\Create as ItemCreate;
use App\Livewire\Pages\Course\Index as CourseIndex;
use App\Livewire\Pages\Employee\Index as EmployeeIndex;
use App\Livewire\Pages\Semester\Index as SemesterIndex;
use App\Livewire\Pages\Employee\Create as EmployeeCreate;
use App\Livewire\Pages\Department\Index as DepartmentIndex;
use App\Livewire\Pages\Laboratory\Index as LaboratoryIndex;
use App\Livewire\Pages\Permission\Index as PermissionIndex;
use App\Livewire\Pages\AcademicWeek\Index as AcademicWeekIndex;
use App\Livewire\Pages\AcademicYear\Index as AcademicYearIndex;
use App\Livewire\Pages\StudyProgram\Index as StudyProgramIndex;
use App\Livewire\Pages\LbsUsagePermit\Edit as LbsUsagePermitEdit;
use App\Livewire\Pages\ToolInventory\Index as ToolInventoryIndex;
use App\Livewire\Pages\LbsUsagePermit\Index as LbsUsagePermitIndex;
use App\Livewire\Pages\SemesterCourse\Index as SemesterCourseIndex;
use App\Livewire\Pages\LbsUsagePermit\Create as LbsUsagePermitCreate;
use App\Livewire\Pages\CourseInstructor\Index as CourseInstructorIndex;
use App\Livewire\Pages\DamagedLostReport\Index as DamagedLostReportIndex;
use App\Livewire\Pages\MaterialInventory\Index as MaterialInventoryIndex;
use App\Livewire\Pages\ScheduleReplacement\Edit as ScheduleReplacementEdit;
use App\Livewire\Pages\ScheduleReplacement\Index as ScheduleReplacementIndex;
use App\Livewire\Pages\ScheduleReplacement\Create as ScheduleReplacementCreate;
use App\Livewire\Pages\PracticumEquipmentLoan\Edit as PracticumEquipmentLoanEdit;
use App\Livewire\Pages\HandoverPracticalResult\Edit as HandoverPracticalResultEdit;
use App\Livewire\Pages\PracticumEquipmentLoan\Index as PracticumEquipmentLoanIndex;
use App\Livewire\Pages\HandoverPracticalResult\Index as HandoverPracticalResultIndex;
use App\Livewire\Pages\PracticumEquipmentLoan\Create as PracticumEquipmentLoanCreate;
use App\Livewire\Pages\HandoverPracticalResult\Create as HandoverPracticalResultCreate;
use App\Livewire\Pages\PracticumMaterialReadiness\Edit as PracticumMaterialReadinessEdit;
use App\Livewire\Pages\PracticumMaterialReadiness\Index as PracticumMaterialReadinessIndex;
use App\Livewire\Pages\PracticumMaterialReadiness\Create as PracticumMaterialReadinessCreate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::view('/', 'welcome');

Route::get('/', Homepage::class)
    ->name('homepage');

// Route::view('/', 'homepage')
//     ->middleware(['auth', 'verified'])
//     ->name('homepage');

Route::get('/pegawai', EmployeeIndex::class)
    ->name('employee');

Route::get('/pegawai/tambah', EmployeeCreate::class)
    ->name('pegawai.tambah');


Route::prefix('role')->group(function() {
    Route::get('/', Index::class)
        ->name('role');

    Route::get('/tambah', Create::class)
        ->name('role.create');

    Route::get('/{id}/ubah', Edit::class)
        ->name('role.edit');
});

Route::get('/permission', PermissionIndex::class)
        ->name('permission');

Route::get('/jurusan', DepartmentIndex::class)
        ->name('department');

Route::get('/program-studi', StudyProgramIndex::class)
        ->name('study-program');

Route::get('/satuan', UnitIndex::class)
        ->name('unit');

Route::get('/barang', ItemIndex::class)
    ->name('item');

Route::get('/laboratorium', LaboratoryIndex::class)
    ->name('laboratory');

Route::get('/tahun-ajaran', AcademicYearIndex::class)
    ->name('academic-year');


Route::get('/minggu-akademik', AcademicWeekIndex::class)
    ->name('academic-week');

Route::get('/semester', SemesterIndex::class)
    ->name('semester');

Route::get('/matakuliah', CourseIndex::class)
    ->name('course');

Route::get('/matakuliah-semester', SemesterCourseIndex::class)
    ->name('semester-course');

Route::get('/pengampu-matakuliah', CourseInstructorIndex::class)
    ->name('course-instructor');

Route::get('/inventaris-bahan', MaterialInventoryIndex::class)
    ->name('material-inventory');

Route::get('/inventaris-alat', ToolInventoryIndex::class)
    ->name('tool-inventory');

Route::prefix('kesiapan-baprak')->group(function() {
    Route::get('/', PracticumMaterialReadinessIndex::class)
        ->name('prac-mat-ready');
    Route::get('/tambah', PracticumMaterialReadinessCreate::class)
        ->name('prac-mat-ready.create');
    Route::get('/{id}/ubah', PracticumMaterialReadinessEdit::class)
        ->name('prac-mat-ready.edit');
});

Route::prefix('peminjaman-alat-praktek')->group(function() {
    Route::get('/', PracticumEquipmentLoanIndex::class)
        ->name('prac-equipment-loan');
    Route::get('/tambah', PracticumEquipmentLoanCreate::class)
        ->name('prac-equipment-loan.create');
    Route::get('/{id}/{type}', PracticumEquipmentLoanEdit::class)
        ->name('prac-equipment-loan.edit');
});

Route::prefix('penggantian-jadwal')->group(function() {
    Route::get('/', ScheduleReplacementIndex::class)
        ->name('schedule-replacement');
    Route::get('/tambah', ScheduleReplacementCreate::class)
        ->name('schedule-replacement.create');
    Route::get('/{id}/edit', ScheduleReplacementEdit::class)
        ->name('schedule-replacement.edit');
});

Route::get('/report-kehilangan', DamagedLostReportIndex::class)
    ->name('damaged-lost-report');

Route::prefix('serah-terima-praktikum')->group(function() {
    Route::get('/', HandoverPracticalResultIndex::class)
        ->name('handover-practical-result');
    Route::get('/tambah', HandoverPracticalResultCreate::class)
        ->name('handover-practical-result.create');
    Route::get('/{id}/edit', HandoverPracticalResultEdit::class)
        ->name('handover-practical-result.edit');
});

Route::prefix('ijin-penggunaan-lbs')->group(function() {
    Route::get('/', LbsUsagePermitIndex::class)
        ->name('lbs-usage-permit');
    Route::get('/tambah', LbsUsagePermitCreate::class)
        ->name('lbs-usage-permit.create');
    Route::get('/{id}/edit', LbsUsagePermitEdit::class)
        ->name('lbs-usage-permit.edit');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
