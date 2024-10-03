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
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('/superadmin/users', [SuperAdminController::class, 'users'])->name('superadmin.users');
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