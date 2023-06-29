<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\PresensiController;
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



Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboradController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);
    Route::get('/presensi/update-profile', [PresensiController::class, 'updateProfile']);
    Route::post('/presensi/proses-update-profile', [PresensiController::class, 'prosesupdateprofile']);
    Route::get('/presensi/history', [PresensiController::class, 'history']);
    Route::post('/presensi/proses-history', [PresensiController::class, 'proseshistory']);
});
