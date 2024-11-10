<?php

use App\Livewire\Pages\Homepage;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Role\Edit as RoleEdit;
use App\Livewire\Pages\Role\Index as RoleIndex;
use App\Livewire\Pages\Unit\Index as UnitIndex;
use App\Livewire\Pages\Role\Create as RoleCreate;
use App\Livewire\Pages\Employee\Index as EmployeeIndex;
use App\Livewire\Pages\Employee\Create as EmployeeCreate;
use App\Livewire\Pages\Department\Index as DepartmentIndex;
use App\Livewire\Pages\Permission\Index as PermissionIndex;
use App\Livewire\Pages\StudyProgram\Index as StudyProgramIndex;

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
    Route::get('/', RoleIndex::class)
        ->name('role');

    Route::get('/role/tambah', RoleCreate::class)
        ->name('role.create');

    Route::get('/role/{id}/ubah', RoleEdit::class)
        ->name('role.edit');
});

Route::get('/permission', PermissionIndex::class)
        ->name('permission');

Route::get('/jurusan', DepartmentIndex::class)
        ->name('department');

Route::get('/jurusan', DepartmentIndex::class)
        ->name('department');

Route::get('/program-studi', StudyProgramIndex::class)
        ->name('study-program');

Route::get('/satuan', UnitIndex::class)
        ->name('unit');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
