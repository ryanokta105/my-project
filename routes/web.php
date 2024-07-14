<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KlasifikasiController;
use App\Models\Barang;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/kategori', [KategoriController::class, 'kategori'])->name('kategori');
    Route::post('/kategori', [KategoriController::class, 'store']);
    Route::delete('/kategori/{kode_kategori}', [KategoriController::class, 'destroy'])->name('destroy');
    Route::get('/kategori/{kode_kategori}/edit_kategori', [KategoriController::class, 'edit_kategori'])->name('edit_kategori');
    Route::put('/kategori/{kode_kategori}', [KategoriController::class, 'update'])->name('update');
    Route::get('{kode_kategori}/barang', [KategoriController::class, 'showBarang'])->name('barang');
    Route::delete('/barang/{kode_barang}', [KategoriController::class, 'destroy_barang'])->name('destroy_barang');

    Route::post('/tambah', [BarangController::class, 'store_barang']);
    Route::get('/barang/{kode_barang}/edit_barang/{kategori}', [BarangController::class, 'edit_barang'])->name('edit_barang');
    Route::put('/barang/{kode_barang}', [BarangController::class, 'update_barang'])->name('update_barang');

    Route::get('/klasifikasi', [KlasifikasiController::class, 'klasifikasi'])->name('klasifikasi');
    Route::post('/tambah_kl', [KlasifikasiController::class, 'store_klasifikasi']);
    Route::delete('/klasifikasi/{id}', [KlasifikasiController::class, 'destroy_klasifikasi'])->name('destroy_klasifikasi');
    Route::get('/klasifikasi/{id}/edit_klasifikasi/{barang}', [KlasifikasiController::class, 'edit_klasifikasi'])->name('edit_klasifikasi');
    Route::put('/klasifikasi/{id}', [KlasifikasiController::class, 'update_klasifikasi'])->name('update_klasifikasi');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
