<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang dilindungi
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('dashboard.home');
    })->name('home');

    // Rute berdasarkan role
    // Route::group(['middleware' => 'role:superadmin'], function () {
    //     Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    // });

    // Route::group(['middleware' => 'role:admin_smp'], function () {
    //     Route::get('admin_smp', [AdminSMPController::class, 'index'])->name('admin_smp.index');
    // });

    // Route::group(['middleware' => 'role:admin_sma'], function () {
    //     Route::get('admin_sma', [AdminSMAController::class, 'index'])->name('admin_sma.index');
    // });
    
    // Route::group(['middleware' => 'role:pembimbing_smp'], function () {
    //     Route::get('pembimbing_smp', [PembimbingSMPController::class, 'index'])->name('pembimbing_smp.index');
    // });
    
    // Route::group(['middleware' => 'role:pembimbing_sma'], function () {
    //     Route::get('pembimbing_sma', [PembimbingSMAController::class, 'index'])->name('pembimbing_sma.index');
    // });
});
