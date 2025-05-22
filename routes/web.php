<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('admin.login');
});

Route::get('/Login', [AdminController::class, 'login'])->name('login');
Route::post('/ceklogin', [AdminController::class, 'ceklogin'])->name('ceklogin');


Route::middleware(['auth', 'can:akses-admin'])->group(function(){
    
    Route::get('/Dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/Data Pasien', [AdminController::class, 'datapasien'])->name('datapasien');
    Route::get('/Riwayat Kunjungan', [AdminController::class, 'riwayatkunjungan'])->name('riwayatkunjungan');
    Route::get('/Data Dokter', [AdminController::class, 'datadokter'])->name('datadokter');
    Route::get('/Data Poli', [AdminController::class, 'datapoli'])->name('datapoli');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::post('/tambahpasien', [AdminController::class, 'tambahpasien'])->name('tambahpasien');
    Route::put('/updatepasien/{id}', [AdminController::class, 'updatepasien'])->name('updatepasien');
    Route::delete('/hapuspasien/{id}', [AdminController::class, 'hapuspasien'])->name('hapuspasien');

    Route::post('/tambahpoli', [AdminController::class, 'tambahpoli'])->name('tambahpoli');
    Route::put('/updatepoli/{id}', [AdminController::class, 'updatepoli'])->name('updatepoli');
    Route::delete('/hapuspoli/{id}', [AdminController::class, 'hapuspoli'])->name('hapuspoli');

    Route::post('/tambahdokter', [AdminController::class, 'tambahdokter'])->name('tambahdokter');
    Route::put('/updatedokter/{id}', [AdminController::class, 'updatedokter'])->name('updatedokter');
    Route::delete('/hapusdokter/{id}', [AdminController::class, 'hapusdokter'])->name('hapusdokter');

    Route::post('/tambahkunjungan', [AdminController::class, 'tambahkunjungan'])->name('tambahkunjungan');
    Route::put('/updatekunjungan/{id}', [AdminController::class, 'updatekunjungan'])->name('updatekunjungan');
    Route::delete('/hapuskunjugan/{id}', [AdminController::class, 'hapuskunjungan'])->name('hapuskunjungan');

    Route::get('/cetakdata/{id}', [AdminController::class, 'cetakdata'])->name('cetakdata');
    Route::get('/cetakexcel', [AdminController::class, 'cetakexcel'])->name('cetakexcel');

});



