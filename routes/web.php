<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\AdminSMAController;
use App\Http\Controllers\AdminSMPController;
use App\Http\Controllers\SiswaSMAController;
use App\Http\Controllers\SiswaSMPController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AnggotaEkskulController;
use App\Http\Controllers\PembimbingSMAController;
use App\Http\Controllers\PembimbingSMPController;
use App\Http\Controllers\SuperAdminUserController;



Route::get('/', function () {
    // Jika pengguna sudah login, arahkan berdasarkan role
    if (Auth::check()) {
        $user = Auth::user();
        $userRoles = $user->roles->pluck('name')->toArray();

        if (in_array('Super Admin', $userRoles)) {
            return redirect()->route('superadmin.index');
        } elseif (in_array('Admin SMA', $userRoles)) {
            return redirect()->route('adminsma.index');
        } elseif (in_array('Admin SMP', $userRoles)) {
            return redirect()->route('adminsmp.index');
        } elseif (in_array('Pembimbing SMA', $userRoles)) {
            return redirect()->route('pembimbingsma.index');
        } elseif (in_array('Pembimbing SMP', $userRoles)) {
            return redirect()->route('pembimbingsmp.index');
        } elseif (in_array('Siswa SMA', $userRoles)) {
            return redirect()->route('siswasma.index');
        } elseif (in_array('Siswa SMP', $userRoles)) {
            return redirect()->route('siswasmp.index');
        }

        // Jika tidak ada role yang cocok, arahkan ke home
        return redirect()->route('home');
    }

    // Jika belum login, arahkan ke halaman login
    return view('auth.login');
});

// Di routes/web.php
Route::get('/home', function () {
    return view('home'); // Anda bisa membuat view home yang sesuai.
})->name('home');



Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::resource('ekskul', EkskulController::class);



// Rute yang dilindungi untuk membuat Users Admin dan Pembimbing
Route::prefix('superadmin')->middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('/users', [SuperAdminUserController::class, 'index'])->name('superadmin.users.index');
    Route::get('/users/create', [SuperAdminUserController::class, 'create'])->name('superadmin.users.create');
    Route::post('/users', [SuperAdminUserController::class, 'store'])->name('superadmin.users.store');
    Route::get('/users/{user}/edit', [SuperAdminUserController::class, 'edit'])->name('superadmin.users.edit');
    Route::put('/users/{user}', [SuperAdminUserController::class, 'update'])->name('superadmin.users.update');
    Route::delete('/users/{user}', [SuperAdminUserController::class, 'destroy'])->name('superadmin.users.destroy');
    Route::get('superadmin/users/{user}', [SuperAdminUserController::class, 'show'])->name('superadmin.users.show');
    Route::post('/users/{id}/toggle-active', [SuperAdminUserController::class, 'toggleActive'])->name('users.toggleActive');
});

// Route untuk membuat Pembimbing SMP
Route::middleware(['auth', 'role:Admin SMP,Super Admin'])->group(function () {
    Route::get('/adminsmp', [AdminSMPController::class, 'index'])->name('adminsmp.index');
    Route::get('/pembimbingsmp', [PembimbingSMPController::class, 'index'])->name('pembimbingsmp.index');
    Route::get('/pembimbingsmp/create', [PembimbingSMPController::class, 'create'])->name('pembimbingsmp.create');
    Route::post('/pembimbingsmp', [PembimbingSMPController::class, 'store'])->name('pembimbingsmp.store');
    Route::get('/pembimbingsmp/{user}/edit', [PembimbingSMPController::class, 'edit'])->name('pembimbingsmp.edit');
    Route::get('/pembimbingsmp/{user}', [PembimbingSMPController::class, 'show'])->name('pembimbingsmp.show');
    Route::put('/pembimbingsmp/{user}', [PembimbingSMPController::class, 'update'])->name('pembimbingsmp.update');
    Route::delete('/pembimbingsmp/{user}', [PembimbingSMPController::class, 'destroy'])->name('pembimbingsmp.destroy');
});

// Route untuk membuat Pembimbing SMA
Route::middleware(['auth', 'role:Admin SMA,Super Admin'])->group(function () {
    Route::get('/adminsma', [AdminSMAController::class, 'index'])->name('adminsma.index');
    Route::get('/pembimbingsma', [PembimbingSMAController::class, 'index'])->name('pembimbingsma.index');
    Route::get('/pembimbingsma/create', [PembimbingSMAController::class, 'create'])->name('pembimbingsma.create');
    Route::post('/pembimbingsma', [PembimbingSMAController::class, 'store'])->name('pembimbingsma.store');
    Route::get('/pembimbingsma/{user}/edit', [PembimbingSMAController::class, 'edit'])->name('pembimbingsma.edit');
    Route::get('/pembimbingsma/{user}', [PembimbingSMAController::class, 'show'])->name('pembimbingsma.show');
    Route::put('/pembimbingsma/{user}', [PembimbingSMAController::class, 'update'])->name('pembimbingsma.update');
    Route::delete('/pembimbingsma/{user}', [PembimbingSMAController::class, 'destroy'])->name('pembimbingsma.destroy');
});

// Route untuk membuat siswa SMA
Route::middleware(['auth', 'role:Pembimbing SMA,Super Admin,Admin SMA'])->group(function () {
    Route::get('siswasma', [SiswaSMAController::class, 'index'])->name('siswasma.index');
    Route::get('siswasma/create', [SiswaSMAController::class, 'create'])->name('siswasma.create');
    Route::post('siswasma', [SiswaSMAController::class, 'store'])->name('siswasma.store');
    Route::get('siswasma/{siswa}/edit', [SiswaSMAController::class, 'edit'])->name('siswasma.edit');
    Route::get('siswasma/{siswa}', [SiswaSMAController::class, 'show'])->name('siswasma.show');
    Route::put('siswasma/{siswa}/edit', [SiswaSMAController::class, 'update'])->name('siswasma.update');
    Route::delete('siswasma/{siswa}', [SiswaSMAController::class, 'destroy'])->name('siswasma.destroy');
});

// Route untuk membuat siswa SMP
Route::middleware(['auth', 'role:Pembimbing SMP,Super Admin,Admin SMP'])->group(function () {
    Route::get('siswasmp', [SiswaSMPController::class, 'index'])->name('siswasmp.index');
    Route::get('siswasmp/create', [SiswaSMPController::class, 'create'])->name('siswasmp.create');
    Route::post('siswasmp', [SiswaSMPController::class, 'store'])->name('siswasmp.store');
    Route::get('siswasmp/{siswa}/edit', [SiswaSMPController::class, 'edit'])->name('siswasmp.edit');
    Route::get('siswasmp/{siswa}', [SiswaSMPController::class, 'show'])->name('siswasmp.show');
    Route::put('siswasmp/{siswa}/edit', [SiswaSMPController::class, 'update'])->name('siswasmp.update');
    Route::delete('siswasmp/{siswa}', [SiswaSMPController::class, 'destroy'])->name('siswasmp.destroy');
});

// Route untuk Pembimbing SMA
Route::middleware(['auth', 'role:Pembimbing SMA'])->group(function () {
    Route::get('/pembimbing-sma', [PembimbingSMAController::class, 'index'])->name('pembimbing.sma.index');
});
Route::middleware(['auth', 'role:Pembimbing SMP'])->group(function () {
    Route::get('/pembimbing-smp', [PembimbingSMPController::class, 'index'])->name('pembimbing.smp.index');
});
// Route untuk Siswa SMP
Route::middleware(['auth', 'role:Siswa SMP'])->group(function () {
    Route::get('/siswa-smp', [SiswaSMPController::class, 'index'])->name('siswa.smp.index');
});

// Route untuk Siswa SMA
Route::middleware(['auth', 'role:Siswa SMA'])->group(function () {
    Route::get('/siswa-sma', [SiswaSMAController::class, 'index'])->name('siswa.sma.index');
});