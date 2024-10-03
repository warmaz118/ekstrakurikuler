<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminSMAController;
use App\Http\Controllers\AdminSMPController;
use App\Http\Controllers\SiswaSMAController;
use App\Http\Controllers\SiswaSMPController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\PembimbingSMAController;
use App\Http\Controllers\PembimbingSMPController;
use App\Http\Controllers\SuperAdminUserController;

Route::get('/', function () {
    return view('auth.login');
});

// Di routes/web.php
Route::get('/home', function () {
    return view('home'); // Anda bisa membuat view home yang sesuai.
})->name('home');



Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang dilindungi
Route::prefix('superadmin')->middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('/users', [SuperAdminUserController::class, 'index'])->name('superadmin.users.index');
    Route::get('/users/create', [SuperAdminUserController::class, 'create'])->name('superadmin.users.create');
    Route::post('/users', [SuperAdminUserController::class, 'store'])->name('superadmin.users.store');
    Route::get('/users/{user}/edit', [SuperAdminUserController::class, 'edit'])->name('superadmin.users.edit');
    Route::put('/users/{user}', [SuperAdminUserController::class, 'update'])->name('superadmin.users.update');
    Route::delete('/users/{user}', [SuperAdminUserController::class, 'destroy'])->name('superadmin.users.destroy');
});
// Route untuk Admin SMP
Route::middleware(['auth', 'role:Admin SMP'])->group(function () {
    Route::get('/admin-smp', [AdminSMPController::class, 'index'])->name('admin.smp.index');
});

// Route untuk Admin SMA
Route::middleware(['auth', 'role:Admin SMA'])->group(function () {
    Route::get('/admin-sma', [AdminSMAController::class, 'index'])->name('admin.sma.index');
});

// Route untuk Pembimbing SMP
Route::middleware(['auth', 'role:Pembimbing SMP'])->group(function () {
    Route::get('/pembimbing-smp', [PembimbingSMPController::class, 'index'])->name('pembimbing.smp.index');
});

// Route untuk Pembimbing SMA
Route::middleware(['auth', 'role:Pembimbing SMA'])->group(function () {
    Route::get('/pembimbing-sma', [PembimbingSMAController::class, 'index'])->name('pembimbing.sma.index');
});

// Route untuk Siswa SMP
Route::middleware(['auth', 'role:Siswa SMP'])->group(function () {
    Route::get('/siswa-smp', [SiswaSMPController::class, 'index'])->name('siswa.smp.index');
});

// Route untuk Siswa SMA
Route::middleware(['auth', 'role:Siswa SMA'])->group(function () {
    Route::get('/siswa-sma', [SiswaSMAController::class, 'index'])->name('siswa.sma.index');
});