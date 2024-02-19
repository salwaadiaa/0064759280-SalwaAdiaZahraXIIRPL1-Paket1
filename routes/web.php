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

Route::middleware(['web', 'auth', 'preventBackAfterLogout'])->group(function () {
    Route::get('/dashboard', [RouteController::class, 'dashboard'])->name('home');
    Route::get('/profile', [ProfileController::class, 'myProfile'])->name('profile');
    Route::put('/profile/change-ava', [ProfileController::class, 'changeFotoProfile'])->name('change-ava');
    Route::put('/profile/change-profile', [ProfileController::class, 'changeProfile'])->name('change-profile');

    Route::resource('users', UserController::class)->middleware(['auth', 'roles:admin']);

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index')->middleware(['auth', 'roles:admin,petugas']);
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create')->middleware(['auth', 'roles:admin,petugas']);
    Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store')->middleware(['auth', 'roles:admin,petugas']);
    Route::get('/buku/edit/{buku_id}', [BukuController::class, 'edit'])->name('buku.edit')->middleware(['auth', 'roles:admin,petugas']);
    Route::put('/buku/update/{buku_id}', [BukuController::class, 'update'])->name('buku.update')->middleware(['auth', 'roles:admin,petugas']);
    Route::delete('/buku/destroy/{id}', [BukuController::class, 'destroy'])->name('buku.destroy')->middleware(['auth', 'roles:admin,petugas']);
    Route::post('/buku/tambah-ke-koleksi/{buku_id}', [BukuController::class, 'tambahKeKoleksi'])->name('buku.tambah-ke-koleksi');

    Route::post('/buku/ajukan-peminjaman/{id}', [BukuController::class, 'ajukanPeminjaman'])->name('buku.ajukan-peminjaman');
    Route::get('/user/buku/index', [BukuController::class, 'bukuIndex'])->name('user.buku.index')->middleware(['auth', 'roles:user']);

    Route::get('/peminjaman/exportPdf', [PeminjamanController::class, 'exportPdf'])->name('peminjaman.exportPdf')->middleware(['auth', 'roles:admin']);
    Route::get('/peminjam', [PeminjamanController::class, 'index'])->name('peminjaman.index')->middleware(['auth', 'roles:admin,petugas']);
    Route::get('/peminjam/selesai', [PeminjamanController::class, 'selesai'])->name('peminjaman.selesai');
    Route::put('/peminjaman/approve/{peminjaman_id}', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::put('/peminjaman/reject/{peminjaman_id}', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::put('/peminjaman/return/{peminjaman_id}', [PeminjamanController::class, 'return'])->name('peminjaman.return');

    Route::get('/ulasan', [UlasanBukuController::class, 'index'])->name('ulasan.index')->middleware(['auth', 'roles:user']);
    Route::get('/ulasan/create/{peminjamanId}', [UlasanBukuController::class, 'create'])->name('ulasan.create')->middleware(['auth', 'roles:user']);
    Route::post('/ulasan-buku/store', [UlasanBukuController::class, 'store'])->name('ulasan.store')->middleware(['auth', 'roles:user']);
    Route::get('dashboard/ulasan/buku-di-ulas', [UlasanBukuController::class, 'bukuDiUlas'])->name('dashboard.ulasan.buku-di-ulas');
    Route::get('/admin-petugas/ulasan', [UlasanBukuController::class, 'ulasanAdmin'])->name('ulasan.admin')->middleware(['auth', 'roles:admin,petugas']);

    Route::get('/dashboard/koleksipribadi', [KoleksiPribadiController::class, 'index'])->name('koleksipribadi.index')->middleware(['auth', 'roles:user']);
    Route::delete('/koleksi/{koleksi_id}/hapus', [KoleksiPribadiController::class, 'hapus'])->name('koleksi.hapus')->middleware(['auth', 'roles:user']);

    Route::get('/kategori', [KategoriBukuController::class, 'indexUser'])->name('kategori.user')->middleware(['auth', 'roles:user']);
    Route::get('/admin/kategori', [KategoriBukuController::class, 'indexAdmin'])->name('kategori.admin')->middleware(['auth', 'roles:admin,petugas']);
    Route::get('/admin/kategori/create', [KategoriBukuController::class, 'create'])->name('kategori.create')->middleware(['auth', 'roles:admin,petugas']);
    Route::post('/admin/kategori/store', [KategoriBukuController::class, 'store'])->name('kategori.store')->middleware(['auth', 'roles:admin,petugas']);
    Route::get('admin/kategori/{kategori_id}/edit', [KategoriBukuController::class, 'edit'])->name('kategori.edit')->middleware(['auth', 'roles:admin,petugas']);
    Route::put('admin/kategori/{kategori_id}', [KategoriBukuController::class, 'update'])->name('kategori.update')->middleware(['auth', 'roles:admin,petugas']);
    Route::delete('/admin/kategori/{kategori_id}', [KategoriBukuController::class, 'destroy'])->name('kategori.destroy')->middleware(['auth', 'roles:admin,petugas']);
});

Route::get('/', [BukuController::class, 'landing']);
require __DIR__.'/auth.php';
