<?php

use App\Livewire\Pages\Homepage;
use App\Livewire\Pages\Pegawai\Index;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Pegawai\Tambah;
use App\Livewire\Pages\Permission\Index as PermissionIndex;
use App\Livewire\Pages\Role\Ubah as RoleUbah;
use App\Livewire\Pages\Role\Index as RoleIndex;
use App\Livewire\Pages\Role\Tambah as RoleTambah;

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

Route::get('/pegawai', Index::class)
    ->name('pegawai');
// Route::get('/pegawai/tambah', Tambah::class)
//     ->name('pegawai.tambah');


Route::prefix('role')->group(function() {
    Route::get('/', RoleIndex::class)
        ->name('role');

    Route::get('/role/tambah', RoleTambah::class)
        ->name('role.tambah');

    Route::get('/role/{id}/ubah', RoleUbah::class)
        ->name('role.ubah');
});

Route::get('/permission', PermissionIndex::class)
        ->name('permission');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
