<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\JamkerjaController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use App\Models\KantorCabang;
use GuzzleHttp\Psr7\Request;
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

Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin',[AuthController::class,'proseslogin']);
});

Route::middleware(['guest:user'])->group(function(){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin',[AuthController::class,'prosesloginadmin']);
});

Route::middleware(['auth:karyawan'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/proseslogout',[AuthController::class,'proseslogout']);

    Route::get('/presensi/create',[PresensiController::class,'create']);
    Route::post('/presensi/store',[PresensiController::class,'store']);

    //editprofile
    Route::get('/editprofile',[PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);
    Route::get('/presensi/histori',[PresensiController::class,'histori']);

    Route::post('/gethistori',[PresensiController::class,'gethistori']);

    //izin
    Route::get('/presensi/izin', [PresensiController::class,'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class,'storeizin']);
    Route::post('/presensi/checkpengajuanizin', [PresensiController::class,'checkpengajuanizin']);
});


Route::middleware(['auth:user'])->group(function(){
    //login administrator
    Route::get('/panel/dashboardadmin', [DashboardController::class,'dashboardadmin']);
    Route::get('/proseslogoutadmin',[AuthController::class,'proseslogoutadmin']);

    // Karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/{nik}/update', [KaryawanController::class, 'update']);
    Route::post('/karyawan/{nik}/delete', [KaryawanController::class, 'delete']);

    // Departemen
    Route::get('/departemen', [DepartemenController::class, 'home']);
    Route::post('/departemen/store', [DepartemenController::class, 'store']);
    Route::post('/departemen/edit', [DepartemenController::class, 'edit']);
    Route::post('/departemen/{kode_dept}/update', [DepartemenController::class, 'update']);
    Route::post('/departemen/{kode_dept}/delete', [DepartemenController::class, 'delete']);

    // monitoring presensi
    Route::get('/presensi/monitoring', [PresensiController::class,'monitoring']);
    Route::post('/getpresensi', [PresensiController::class,'getpresensi']);
    Route::post('/tampilkanpeta', [PresensiController::class,'tampilkanpeta']);
    Route::get('/presensi/laporanpresensi', [PresensiController::class,'laporanpresensi']);
    Route::post('/presensi/cetaklaporan', [PresensiController::class,'cetaklaporan']);
    Route::get('/presensi/rekappresensi', [PresensiController::class,'rekappresensi']);
    Route::post('/presensi/cetakrekap', [PresensiController::class,'cetakrekap']);

    Route::get('/presensi/approvalizin', [PresensiController::class,'approvalizin']);
    Route::post('/presensi/approveizinsakit', [PresensiController::class,'approveizinsakit']);
    Route::get('/presensi/{id}/batalkanizinsakit', [PresensiController::class,'batalkanizinsakit']);

    //konfigurasi
    Route::get('/konfigurasi/lokasikantor', [KonfigurasiController::class,'lokasikantor']);
    Route::post('/konfigurasi/updatelokasikantor', [KonfigurasiController::class,'updatelokasikantor']);
    Route::get('/konfigurasi/jamkerja', [KonfigurasiController::class,'jamkerja']);
    Route::post('/konfigurasi/jamkerja/store', [KonfigurasiController::class,'jamkerjastore']);
    Route::post('/konfigurasi/jamkerja/edit', [KonfigurasiController::class,'jamkerjaedit']);
    Route::post('/konfigurasi/jamkerja/{kode_jamkerja}/update', [KonfigurasiController::class, 'jamkerjaupdate']);
    Route::post('/konfigurasi/jamkerja/{kode_jamkerja}/delete', [KonfigurasiController::class, 'jamkerjadelete']);
    Route::get('/konfigurasi/{nik}/setjamkerja', [KonfigurasiController::class, 'setjamkerja']);
    Route::post('/konfigurasi/jamkerja/{nik}/jadwalkerja', [KonfigurasiController::class, 'jadwalkerja']);

    // kantor cabang
    Route::get('/kantorcabang', [CabangController::class, 'index']);
    Route::post('/kantorcabang/store', [CabangController::class, 'store']);
    Route::post('/kantorcabang/edit', [CabangController::class, 'edit']);
    Route::post('/kantorcabang/{kode_cabang}/update', [CabangController::class, 'update']);
    Route::post('/kantorcabang/{kode_cabang}/delete', [CabangController::class, 'delete']);

});


