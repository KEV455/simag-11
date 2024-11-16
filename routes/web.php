<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardKoordinatorController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\KategoriBidangController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\UserController;

Route::middleware(['guest'])->group(function () {
    // Route Authentication
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('do.login');

    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    // Route Authentication
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route for Admin
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard.admin');

    // Route Manajemen Jurusan
    Route::get('/admin/manajemen-jurusan', [JurusanController::class, 'index'])->name('admin.jurusan.index');
    Route::post('/admin/manajemen-jurusan/create', [JurusanController::class, 'store'])->name('admin.jurusan.create');
    Route::get('/admin/manajemen-jurusan/{id}/delete', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');
    Route::put('/admin/manajemen-jurusan/{id}/update', [JurusanController::class, 'update'])->name('admin.jurusan.update');

    // Route Manajemen Prodi
    Route::get('/admin/manajemen-prodi', [ProdiController::class, 'index'])->name('admin.prodi.index');
    Route::post('/admin/manajemen-prodi/create', [ProdiController::class, 'store'])->name('admin.prodi.create');
    Route::get('/admin/manajemen-prodi/{id}/delete', [ProdiController::class, 'destroy'])->name('admin.prodi.destroy');
    Route::put('/admin/manajemen-prodi/{id}/update', [ProdiController::class, 'update'])->name('admin.prodi.update');

    // Route Manajemen Dosen
    Route::get('/admin/manajemen-dosen', [DosenController::class, 'index'])->name('admin.dosen.index');
    Route::get('/admin/manajemen-dosen/create', [DosenController::class, 'create'])->name('admin.dosen.create');
    Route::post('/admin/manajemen-dosen/store', [DosenController::class, 'store'])->name('admin.dosen.store');
    Route::get('/admin/manajemen-dosen/{id}/edit', [DosenController::class, 'edit'])->name('admin.dosen.edit');
    Route::put('/admin/manajemen-dosen/{id}/update', [DosenController::class, 'update'])->name('admin.dosen.update');
    Route::get('/admin/manajemen-dosen/{id}/delete', [DosenController::class, 'destroy'])->name('admin.dosen.destroy');
    Route::post('/admin/manajemen-dosen/import', [DosenController::class, 'import'])->name('admin.dosen.import');

    // Route Manajemen Koordinator
    Route::get('/admin/manajemen-koordinator', [KoordinatorController::class, 'index'])->name('admin.koordinator.index');
    Route::post('/admin/manajemen-koordinator/store', [KoordinatorController::class, 'store'])->name('admin.koordinator.store');
    Route::put('/admin/manajemen-koordinator/{id}/update', [KoordinatorController::class, 'update'])->name('admin.koordinator.update');
    Route::get('/admin/manajemen-koordinator/{id}/delete', [KoordinatorController::class, 'destroy'])->name('admin.koordinator.destroy');

    //Route Manjemen User
    Route::get('/admin/manajemen-user', [UserController::class, 'index'])->name('admin.user.index');
    Route::post('/admin/manajemen-user/store', [UserController::class, 'store'])->name('admin.user.store');
    // Route Manajemen Kaprodi
    Route::get('/admin/manajemen-kaprodi', [KaprodiController::class, 'index'])->name('admin.kaprodi.index');
    Route::post('/admin/manajemen-kaprodi/store', [KaprodiController::class, 'store'])->name('admin.kaprodi.store');
    Route::put('/admin/manajemen-kaprodi/{id}/update', [KaprodiController::class, 'update'])->name('admin.kaprodi.update');
    Route::get('/admin/manajemen-kaprodi/{id}/delete', [KaprodiController::class, 'destroy'])->name('admin.kaprodi.destroy');
});

Route::middleware(['auth', 'role:koordinator'])->group(function () {
    Route::get('/koordinator/dashboard', [DashboardKoordinatorController::class, 'index'])->name('dashboard.koordinator');

    // Route Manajemen Kategori Bidang
    Route::get('/koordinator/manajemen-kategori-bidang', [KategoriBidangController::class, 'index'])->name('koordinator.kategori.bidang.index');
    Route::post('/koordinator/manajemen-kategori-bidang/create', [KategoriBidangController::class, 'store'])->name('koordinator.kategori.bidang.create');
    Route::get('/koordinator/manajemen-kategori-bidang/delete/{id}', [KategoriBidangController::class, 'destroy'])->name('koordinator.kategori.bidang.destroy');
    Route::put('/koordinator/manajemen-kategori-bidang/{id}/update', [KategoriBidangController::class, 'update'])->name('koordinator.kategori.bidang.update');

    // Route Manajemen Mitra
    Route::get('/koordinator/manajemen-mitra', [MitraController::class, 'index'])->name('koordinator.mitra.index');
    Route::get('/koordinator/manajemen-mitra/create', [MitraController::class, 'create'])->name('koordinator.mitra.create');
    Route::post('/koordinator/manajemen-mitra/store', [MitraController::class, 'store'])->name('koordinator.mitra.store');
    Route::get('/koordinator/manajemen-mitra/{id}/edit', [MitraController::class, 'edit'])->name('koordinator.mitra.edit');
    Route::put('/koordinator/manajemen-mitra/{id}/update', [MitraController::class, 'update'])->name('koordinator.mitra.update');
    Route::get('/koordinator/manajemen-mitra/delete/{id}', [MitraController::class, 'destroy'])->name('koordinator.mitra.destroy');

    //Route Manaemen Berkas
    Route::get('/koordinator/manajemen-berkas', [BerkasController::class, 'index'])->name('koordinator.berkas.index');
    Route::post('/koordinator/manajemen-berkas/create', [BerkasController::class, 'store'])->name('koordinator.berkas.create');
    Route::get('/koordinator/manajemen-berkas/delete/{id}', [BerkasController::class, 'destroy'])->name('koordinator.berkas.destroy');
    Route::put('/koordinator/manajemen-berkas/{id}/update', [BerkasController::class, 'update'])->name('koordinator.berkas.update');

    // Route Manajemen Lowongan
    Route::get('/koordinator/manajemen-lowongan/index.php', [LowonganController::class, 'index'])->name('koordinator.lowongan.index');
    Route::post('/koordinator/manajemen-lowongan/create', [LowonganController::class, 'store'])->name('koordinator.lowongan.create');
    Route::get('/koordinator/manajemen-lowongan/delete/{id}', [LowonganController::class, 'destroy'])->name('koordinator.lowongan.destroy');
    Route::put('/koordinator/manajemen-lowongan/{id}/update', [LowonganController::class, 'update'])->name('koordinator.lowongan.update');
});

// Route::middleware(['auth', 'role:admin,koordinator'])->group(function () {
//     // route
// });

// route yang masih belum dipakai
// Route::get('/dashboard/mahasiswa', fn() => view('dashboard.mahasiswa'))->name('dashboard.mahasiswa');
// Route::get('/dashboard/dospem', fn() => view('dashboard.dospem'))->name('dashboard.dospem');
// Route::get('/dashboard/kaprodi', fn() => view('dashboard.kaprodi'))->name('dashboard.kaprodi');
// Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
