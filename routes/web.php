<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\KoleksiPribadiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TreeviewController;
use App\Http\Controllers\UlasanBukuController;

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

# ------ Unauthenticated routes ------ #
Route::get('/', [AuthenticatedSessionController::class, 'create']);
require __DIR__.'/auth.php';


# ------ Authenticated routes ------ #
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [RouteController::class, 'dashboard'])
    ->name('home')
    ->middleware('auth');

    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileController::class, 'myProfile'])->name('profile');
        Route::put('/change-ava', [ProfileController::class, 'changeFotoProfile'])->name('change-ava');
        Route::put('/change-profile', [ProfileController::class, 'changeProfile'])->name('change-profile');
    }); # profile group

    Route::resource('users', UserController::class);
    Route::resource('treeview', TreeviewController::class)->only('index');
    Route::resource('profit', ProfitController::class)->only('index');

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/edit/{buku_id}', [BukuController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/update/{buku_id}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/destroy/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
    Route::post('/buku/tambah-ke-koleksi/{buku_id}', [BukuController::class, 'tambahKeKoleksi'])->name('buku.tambah-ke-koleksi');
    Route::get('/user/buku/index', [BukuController::class, 'bukuIndex'])->name('user.buku.index');
    Route::post('/buku/ajukan-peminjaman/{id}', [BukuController::class, 'ajukanPeminjaman'])->name('buku.ajukan-peminjaman');

    Route::get('/peminjaman/exportPdf', [PeminjamanController::class, 'exportPdf'])->name('peminjaman.exportPdf');
    Route::get('/peminjam', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::put('/peminjaman/approve/{peminjaman_id}', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::put('/peminjaman/reject/{peminjaman_id}', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::put('/peminjaman/return/{peminjaman_id}', [PeminjamanController::class, 'return'])->name('peminjaman.return');

    Route::get('/ulasan', [UlasanBukuController::class, 'index'])->name('ulasan.index');
    Route::get('/ulasan/create/{peminjamanId}', [UlasanBukuController::class, 'create'])->name('ulasan.create');
    Route::post('/ulasan-buku/store', [UlasanBukuController::class, 'store'])->name('ulasan.store');
    Route::get('dashboard/ulasan/buku-di-ulas', [UlasanBukuController::class, 'bukuDiUlas'])->name('dashboard.ulasan.buku-di-ulas');
    Route::get('/admin/ulasan', [UlasanBukuController::class, 'ulasanAdmin'])->name('ulasan.admin');

    Route::get('/dashboard/koleksipribadi', [KoleksiPribadiController::class, 'index'])->name('koleksipribadi.index');
    Route::delete('/koleksi/{koleksi_id}/hapus', [KoleksiPribadiController::class, 'hapus'])->name('koleksi.hapus');

    Route::get('/kategori', [KategoriBukuController::class, 'indexUser'])->name('kategori.user');
    Route::get('/admin/kategori', [KategoriBukuController::class, 'indexAdmin'])->name('kategori.admin');
    Route::get('/admin/kategori/create', [KategoriBukuController::class, 'create'])->name('kategori.create');
    Route::post('/admin/kategori/store', [KategoriBukuController::class, 'store'])->name('kategori.store');
    Route::get('admin/kategori/{kategori_id}/edit', [KategoriBukuController::class, 'edit'])->name('kategori.edit');
    Route::put('admin/kategori/{kategori_id}', [KategoriBukuController::class, 'update'])->name('kategori.update');
    Route::delete('/admin/kategori/{kategori_id}', [KategoriBukuController::class, 'destroy'])->name('kategori.destroy');

});
