<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('index');
});*/

Route::get('/', [App\Http\Controllers\MahasiswaController::class, 'index']);



Route::get('/mahasiswa/tambah', [App\Http\Controllers\MahasiswaController::class, 'create']);
Route::get('/mahasiswa/tambah/form', [App\Http\Controllers\MahasiswaController::class, 'tambah_mhs']);
Route::get('/mahasiswa/tambah/data', [App\Http\Controllers\MahasiswaController::class, 'store']);
Route::get('/mahasiswa/edit/{nim}', [App\Http\Controllers\MahasiswaController::class, 'edit']);
Route::get('/mahasiswa/update/{nim}', [App\Http\Controllers\MahasiswaController::class, 'update']);
Route::get('/mahasiswa/hapus/{nim}', [App\Http\Controllers\MahasiswaController::class, 'destroy']);


//route prodi
Route::get('/prodi', [App\Http\Controllers\ProdiController::class, 'index']);
Route::post('/prodi/tambah', [App\Http\Controllers\ProdiController::class, 'store']);
Route::get('/edit/{kode_prodi}', [App\Http\Controllers\ProdiController::class, 'edit'])->name('edit-prodi');
Route::post('/prodi/edit-prodi', [App\Http\Controllers\ProdiController::class, 'update'])->name('edit-proses');
Route::delete('/delete/{kode_prodi}', [App\Http\Controllers\ProdiController::class, 'destroy'])->name('delete');

//route buku
Route::get('/buku', [App\Http\Controllers\BukuController::class, 'index']);
Route::post('/buku/tambah',[BukuController::class,'store'])->name('tambah_buku'); //aksi tambah buku
Route::get('/show/{kode_buku}', [BukuController::class, 'show'])->name('edit-buku');//show edit
Route::post('/buku/edit-proses', [BukuController::class, 'update'])->name('edit-proses1');// edit proses
Route::delete('/delete/{kode_prodi}', [BukuController::class, 'destroy'])->name('delete');

//route pinjam
Route::get('/peminjaman', [App\Http\Controllers\PeminjamanController::class, 'index']);
Route::post('/peminjaman/autocomplete',[App\Http\Controllers\PeminjamanController::class, 'aksiAutoComplete'])->name('peminjam.cari');
Route::post('/peminjaman/buku/autocomplete',[App\Http\Controllers\PeminjamanController::class, 'getDataBuku'])->name('peminjam.buku');
Route::get('/peminjaman/tambah',[App\Http\Controllers\PeminjamanController::class, 'store'])->name('peminjam.tambah');

//route kembali
Route::get('/kembali', [App\Http\Controllers\PeminjamanController::class, 'indexKembali']);
Route::get('/kembali/{nim}', [App\Http\Controllers\PeminjamanController::class, 'show'])->name('kembali.nim');
Route::post('/kembali/tambah', [App\Http\Controllers\PeminjamanController::class, 'showKembali']);//show kembali

//informasi
Route::get('/infopinjam', [App\Http\Controllers\PeminjamanController::class, 'infopinjam']);
Route::get('/lihatmhs/{nim}', [App\Http\Controllers\PeminjamanController::class, 'lihatmhs']);

