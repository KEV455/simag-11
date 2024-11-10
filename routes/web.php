<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware(['guest'])->group(function () {
    // Route Authentication
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('do.login');
});

Route::middleware(['auth'])->group(function () {
    // Route Authentication
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route Dashboard
    Route::get('/dashboard/admin', fn() => view('dashboard.admin'))->name('dashboard.admin');
    Route::get('/dashboard/mahasiswa', fn() => view('dashboard.mahasiswa'))->name('dashboard.mahasiswa');
    Route::get('/dashboard/dospem', fn() => view('dashboard.dospem'))->name('dashboard.dospem');
    Route::get('/dashboard/kaprodi', fn() => view('dashboard.kaprodi'))->name('dashboard.kaprodi');
    Route::get('/dashboard/koordinator', fn() => view('dashboard.koordinator'))->name('dashboard.koordinator');
});

Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');

// Route::get('/', function () {
//     return view('welcome');
// });
