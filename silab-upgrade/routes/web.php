<?php

use App\Livewire\Pages\Pegawai\Edit as PegawaiEdit;
use App\Livewire\Pages\Pegawai\Index as PegawaiIndex;
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

Route::view('/', 'beranda')
    // ->middleware(['auth', 'verified'])
    ->name('beranda');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('pegawai', PegawaiIndex::class)
    ->name('pegawai');

// Route::get('pegawai', PegawaiEdit::class)
//     ->name('pegawai');

require __DIR__.'/auth.php';
