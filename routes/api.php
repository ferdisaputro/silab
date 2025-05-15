<?php

use App\Http\Controllers\api\DashboardController;
use App\Http\Controllers\api\DepartmentController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\EquipmentLoanController;
use App\Http\Controllers\api\ItemController;
use App\Http\Controllers\api\LaboratoryController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\StudyProgramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('/dashboard', DashboardController::class);
Route::resource('/pegawai', EmployeeController::class);
Route::resource('/barang', ItemController::class);
Route::resource('/program-studi', StudyProgramController::class);
Route::resource('/laboratorium', LaboratoryController::class);
Route::resource('/jurusan', DepartmentController::class);
Route::resource('/peminjaman', EquipmentLoanController::class)->parameters([
    'peminjaman' => 'equipment_loan'
]);

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
