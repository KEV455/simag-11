<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardKoordinatorController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KategoriBidangController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProdiController;

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
    Route::get('/admin/manajemen-jurusan/delete/{id}', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');
    Route::put('/admin/manajemen-jurusan/{id}/update', [JurusanController::class, 'update'])->name('admin.jurusan.update');

    // Route Manajemen Prodi
    Route::get('/admin/manajemen-prodi', [ProdiController::class, 'index'])->name('admin.prodi.index');
    Route::post('/admin/manajemen-prodi/create', [ProdiController::class, 'store'])->name('admin.prodi.create');
    Route::get('/admin/manajemen-prodi/delete/{id}', [ProdiController::class, 'destroy'])->name('admin.prodi.destroy');
    Route::put('/admin/manajemen-prodi/{id}/update', [ProdiController::class, 'update'])->name('admin.prodi.update');

    // Route Manajemen Dosen
    Route::get('/admin/manajemen-dosen', [DosenController::class, 'index'])->name('admin.dosen.index');
    Route::get('/admin/manajemen-dosen/create', [DosenController::class, 'create'])->name('admin.dosen.create');
    Route::post('/admin/manajemen-dosen/store', [DosenController::class, 'store'])->name('admin.dosen.store');
    Route::get('/admin/manajemen-dosen/{id}/edit', [DosenController::class, 'edit'])->name('admin.dosen.edit');
    Route::put('/admin/manajemen-dosen/{id}/update', [DosenController::class, 'update'])->name('admin.dosen.update');
    Route::get('/admin/manajemen-dosen/delete/{id}', [DosenController::class, 'destroy'])->name('admin.dosen.destroy');
    Route::post('/admin/manajemen-dosen/import', [DosenController::class, 'import'])->name('admin.dosen.import');
});

Route::middleware(['auth', 'role:koordinator'])->group(function () {
    Route::get('/koordinator/dashboard', [DashboardKoordinatorController::class, 'index'])->name('dashboard.koordinator');

    // Route Manajemen Kategori Bidang
    Route::get('/koordinator/manajemen-kategori-bidang', [KategoriBidangController::class, 'index'])->name('admin.kategori.bidang.index');
    Route::post('/koordinator/manajemen-kategori-bidang/create', [KategoriBidangController::class, 'store'])->name('admin.kategori.bidang.create');
    Route::get('/koordinator/manajemen-kategori-bidang/delete/{id}', [KategoriBidangController::class, 'destroy'])->name('admin.kategori.bidang.destroy');
    Route::put('/koordinator/manajemen-kategori-bidang/{id}/update', [KategoriBidangController::class, 'update'])->name('admin.kategori.bidang.update');

    // Route Manajemen Mitra
    Route::get('/koordinator/manajemen-mitra', [MitraController::class, 'index'])->name('admin.mitra.index');
    Route::get('/koordinator/manajemen-mitra/create', [MitraController::class, 'create'])->name('admin.mitra.create');
    Route::post('/koordinator/manajemen-mitra/store', [MitraController::class, 'store'])->name('admin.mitra.store');
    Route::get('/koordinator/manajemen-mitra/{id}/edit', [MitraController::class, 'edit'])->name('admin.mitra.edit');
    Route::put('/koordinator/manajemen-mitra/{id}/update', [MitraController::class, 'update'])->name('admin.mitra.update');
    Route::get('/admin/manajemen-mitra/delete/{id}', [MitraController::class, 'destroy'])->name('admin.mitra.destroy');

    // Route Manaemen Berkas
    Route::get('/koordinator/manajemen-berkas', [BerkasController::class, 'index'])->name('admin.berkas.index');
    Route::post('/koordinator/manajemen-berkas/create', [BerkasController::class, 'store'])->name('admin.berkas.create');
    Route::get('/koordinator/manajemen-berkas/delete/{id}', [BerkasController::class, 'destroy'])->name('admin.berkas.destroy');
    Route::put('/koordinator/manajemen-berkas/{id}/update', [BerkasController::class, 'update'])->name('admin.berkas.update');
});

// Route::middleware(['auth', 'role:admin,koordinator'])->group(function () {
//     // route
// });

// route yang masih belum dipakai
// Route::get('/dashboard/mahasiswa', fn() => view('dashboard.mahasiswa'))->name('dashboard.mahasiswa');
// Route::get('/dashboard/dospem', fn() => view('dashboard.dospem'))->name('dashboard.dospem');
// Route::get('/dashboard/kaprodi', fn() => view('dashboard.kaprodi'))->name('dashboard.kaprodi');
// Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
