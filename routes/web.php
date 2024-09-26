<?php

use App\Http\Controllers\AlatKontrasepsiController;
use App\Http\Controllers\EkseptorController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PemantauanController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\SasaranController;
use App\Http\Controllers\UserController;
use App\Models\Ekseptor;
use App\Models\Sasaran;
use Illuminate\Support\Facades\Auth;
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



Route::get('/', 'HomeController@homepage');
Route::get('/detail/{kode_alat}', 'HomeController@detail');
Auth::routes(['register' => false, 'reset' => false]);

Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/akseptor_chart', 'HomeController@akseptor_chart');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
    //ekseptor
    Route::get('/ekseptor', [EkseptorController::class, 'index'])->name('ekseptor');
    Route::get('/ekseptor-datatable', [EkseptorController::class, 'getEkseptorDataTable']);
    //sasaran
    Route::get('/sasaran', [SasaranController::class, 'index'])->name('sasaran');
    Route::get('/sasaran-datatable', [SasaranController::class, 'getSasaranDataTable']);
    //pelayanan
    Route::get('/pelayanan', [PelayananController::class, 'index'])->name('pelayanan');
    Route::get('/pelayanan-datatable', [PelayananController::class, 'getPelayananDataTable']);
    //pemantauan
    Route::get('/pemantauan', [PemantauanController::class, 'index'])->name('pemantauan');
    Route::get('/pemantauan-datatable', [PemantauanController::class, 'getPemantauanDataTable']);
    //laporan
    Route::get('/laporan/pelayanan', [LaporanController::class, 'pelayanan'])->name('laporan.pelayanan');
    Route::get('/laporan/ekseptor', [LaporanController::class, 'ekseptor'])->name('laporan.ekseptor');
    Route::post('/laporan/print_ekseptor', [LaporanController::class, 'print_ekseptor'])->name('laporan.print_ekseptor');
    Route::post('/laporan/print_pelayanan', [LaporanController::class, 'print_pelayanan'])->name('laporan.print_pelayanan');
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {
    //ekseptor
    Route::post('/alat/store',  [AlatKontrasepsiController::class, 'store'])->name('alat.store');
    Route::get('/alat/edit/{id}',  [AlatKontrasepsiController::class, 'edit'])->name('alat.edit');
    Route::delete('/alat/delete/{id}',  [AlatKontrasepsiController::class, 'destroy'])->name('alat.delete');
});
Route::middleware(['auth:web', 'role:Operator'])->group(function () {
    //kelurahan
    Route::get('/kelurahan', [KelurahanController::class, 'index'])->name('kelurahan');
    Route::get('/kelurahan-datatable', [KelurahanController::class, 'getKelurahanDataTable']);
    Route::post('/kelurahan/store',  [KelurahanController::class, 'store'])->name('kelurahan.store');
    Route::get('/kelurahan/edit/{id}',  [KelurahanController::class, 'edit'])->name('kelurahan.edit');
    Route::delete('/kelurahan/delete/{id}',  [KelurahanController::class, 'destroy'])->name('kelurahan.delete');

    //setting
    Route::get('/update_puskesmas', [PuskesmasController::class, 'puskesmas'])->name('update_puskesmas');
    Route::put('/update_puskesmas/update', [PuskesmasController::class, 'update_puskesmas'])->name('update_puskesmas.update');
    //data ekseptor
    Route::post('/ekseptor/store',  [EkseptorController::class, 'store'])->name('ekseptor.store');
    Route::get('/ekseptor/edit/{id}',  [EkseptorController::class, 'edit'])->name('ekseptor.edit');
    Route::delete('/ekseptor/delete/{id}',  [EkseptorController::class, 'destroy'])->name('ekseptor.delete');
    //data sasaran
    Route::post('/sasaran/store',  [SasaranController::class, 'store'])->name('sasaran.store');
    Route::get('/sasaran/edit/{id}',  [SasaranController::class, 'edit'])->name('sasaran.edit');
    //data pelayanan
    Route::post('/pelayanan/store',  [PelayananController::class, 'store'])->name('pelayanan.store');
    Route::get('/pelayanan/edit/{id}',  [PelayananController::class, 'edit'])->name('pelayanan.edit');
    Route::delete('/pelayanan/delete/{id}',  [PelayananController::class, 'destroy'])->name('pelayanan.delete');
    //data pelayanan
    Route::post('/pemantauan/store',  [PemantauanController::class, 'store'])->name('pemantauan.store');
    Route::get('/pemantauan/edit/{id}',  [PemantauanController::class, 'edit'])->name('pemantauan.edit');
    Route::delete('/pemantauan/delete/{id}',  [PemantauanController::class, 'destroy'])->name('pemantauan.delete');
});
Route::middleware(['auth:web', 'role:Admin'])->group(function () {
    //alat kontrasepsi
    Route::get('/alat', [AlatKontrasepsiController::class, 'index'])->name('alat');
    Route::get('/alat-datatable', [AlatKontrasepsiController::class, 'getAlatDataTable']);
    Route::post('/alat/store',  [AlatKontrasepsiController::class, 'store'])->name('alat.store');
    Route::get('/alat/edit/{id}',  [AlatKontrasepsiController::class, 'edit'])->name('alat.edit');
    Route::delete('/alat/delete/{id}',  [AlatKontrasepsiController::class, 'destroy'])->name('alat.delete');
    //puskesmas
    Route::get('/puskesmas', [PuskesmasController::class, 'index'])->name('puskesmas');
    Route::get('/puskesmas-datatable', [PuskesmasController::class, 'getPuskesmasDataTable']);
    Route::post('/puskesmas/store',  [PuskesmasController::class, 'store'])->name('puskesmas.store');
    Route::get('/puskesmas/edit/{id}',  [PuskesmasController::class, 'edit'])->name('puskesmas.edit');
    Route::delete('/puskesmas/delete/{id}',  [PuskesmasController::class, 'destroy'])->name('puskesmas.delete');

    //pengguna
    Route::get('/user/admin', [UserController::class, 'admin'])->name('user.admin');
    Route::get('/user/operator', [UserController::class, 'operator'])->name('user.operator');
    Route::get('/user/pj', [UserController::class, 'pj'])->name('user.pj');
    Route::get('/user-datatable/{role}', [UserController::class, 'getUserDataTable']);
    Route::post('/user/store',  [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}',  [UserController::class, 'edit'])->name('user.edit');
    Route::delete('/user/delete/{id}',  [UserController::class, 'destroy'])->name('user.delete');
});

Route::get('/about', function () {
    return view('about');
})->name('about');