<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardKoordinatorController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KategoriBidang;
use App\Http\Controllers\KategoriBidangController;
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
});

Route::middleware(['auth', 'role:koordinator'])->group(function () {
    Route::get('/dashboard/koordinator', [DashboardKoordinatorController::class, 'index'])->name('dashboard.koordinator');

    // Route Manajemen Kategori Bidang
    Route::get('/admin/manajemen-kategori-bidang', [KategoriBidangController::class, 'index'])->name('admin.kategori.bidang.index');
    Route::post('/admin/manajemen-kategori-bidang/create', [KategoriBidangController::class, 'store'])->name('admin.kategori.bidang.create');
    Route::get('/admin/manajemen-kategori-bidang/delete/{id}', [KategoriBidangController::class, 'destroy'])->name('admin.kategori.bidang.destroy');
    Route::put('/admin/manajemen-kategori-bidang/{id}/update', [KategoriBidangController::class, 'update'])->name('admin.kategori.bidang.update');
});

// Route::middleware(['auth', 'role:admin,koordinator'])->group(function () {
//     // route
// });

// route yang masih belum dipakai
// Route::get('/dashboard/mahasiswa', fn() => view('dashboard.mahasiswa'))->name('dashboard.mahasiswa');
// Route::get('/dashboard/dospem', fn() => view('dashboard.dospem'))->name('dashboard.dospem');
// Route::get('/dashboard/kaprodi', fn() => view('dashboard.kaprodi'))->name('dashboard.kaprodi');
// Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
