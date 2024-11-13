<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
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

    // Route Manajemen Prodi
    Route::get('/admin/manajemen-prodi', [ProdiController::class, 'index'])->name('admin.prodi.index');
    Route::post('/admin/manajemen-prodi/create', [ProdiController::class, 'store'])->name('admin.prodi.create');
    Route::get('/admin/manajemen-prodi/delete/{id}', [ProdiController::class, 'destroy'])->name('admin.prodi.destroy');
    Route::put('/admin/manajemen-prodi/{id}/update', [ProdiController::class, 'update'])->name('admin.prodi.update');
});

// Route::middleware(['auth', 'role:admin,koordinator'])->group(function () {
//     // route
// });

// route yang masih belum dipakai
// Route::get('/dashboard/mahasiswa', fn() => view('dashboard.mahasiswa'))->name('dashboard.mahasiswa');
// Route::get('/dashboard/dospem', fn() => view('dashboard.dospem'))->name('dashboard.dospem');
// Route::get('/dashboard/kaprodi', fn() => view('dashboard.kaprodi'))->name('dashboard.kaprodi');
// Route::get('/dashboard/koordinator', fn() => view('dashboard.koordinator'))->name('dashboard.koordinator');
// Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');
