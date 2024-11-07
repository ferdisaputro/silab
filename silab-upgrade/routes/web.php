<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Pegawai\Ubah as PegawaiUbah;
use App\Livewire\Pages\Pegawai\Index as PegawaiIndex;
use App\Livewire\Pages\Pegawai\Tambah as PegawaiTambah;

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

Route::get('pegawai/tambah', PegawaiTambah::class)
    ->name('pegawai.tambah');

Route::get('pegawai/{id}/ubah', PegawaiUbah::class)
    ->name('pegawai.ubah');

// Route::get('pegawai', PegawaiEdit::class)
//     ->name('pegawai');

require __DIR__.'/auth.php';
