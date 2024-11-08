<?php

use App\Livewire\Pages\Homepage;
use App\Livewire\Pages\Pegawai\Index;
use App\Livewire\Pages\Pegawai\Tambah;
use Illuminate\Support\Facades\Route;

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
    ->name('pegawai.index');

Route::get('/pegawai/tambah', Tambah::class)
    ->name('pegawai.tambah');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
