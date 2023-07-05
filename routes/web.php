<?php

use App\Http\Controllers\ADashboardController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SettingController;
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

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
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
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/proses-buatizin', [PresensiController::class, 'prosesizin']);
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/panel/dashboardadmin', [DashboradController::class, 'dashboardadmin']);
    Route::get('/panel/proseslogout', [AuthController::class, 'proseslogoutadmin']);
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    Route::post('/karyawan/cek_nik', [KaryawanController::class, 'cek_nik']);
    Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/update', [KaryawanController::class, 'update']);
    Route::post('/karyawan/delete/{nik}', [KaryawanController::class, 'delete']);

    //Departemen
    Route::get('/departemen', [DepartemenController::class, 'index']);
    Route::post('/departemen/store', [DepartemenController::class, 'store']);
    Route::post('/departemen/cek_dep', [DepartemenController::class, 'cek_dep']);
    Route::post('/departemen/edit', [DepartemenController::class, 'edit']);
    Route::post('/departemen/update', [DepartemenController::class, 'update']);
    Route::post('/departemen/delete/{nik}', [DepartemenController::class, 'delete']);

    Route::get('/monitor-presensi', [PresensiController::class, 'monitoring']);
    Route::post('/getMonitor', [PresensiController::class, 'getMonitor']);
    Route::post('/showmap', [PresensiController::class, 'showmap']);
    Route::get('/rekap-presensi', [PresensiController::class, 'rekap']);
    Route::post('/getRekap', [PresensiController::class, 'getRekap']);

    Route::get('/approval', [ApprovalController::class, 'index']);
    Route::post('/approval/edit', [ApprovalController::class, 'edit']);
    Route::post('/approval/update', [ApprovalController::class, 'update']);
    Route::post('/approval/destroy/{id}', [ApprovalController::class, 'destroy']);

    Route::get('/set-lokasikantor', [SettingController::class, 'setLokasi']);
    Route::post('/update', [SettingController::class, 'update']);
});
