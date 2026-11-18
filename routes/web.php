<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackingReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
    Route::view('/tentang-aplikasi', 'about')->name('about');
    Route::view('/panduan', 'guide')->name('guide');

    Route::get('/packing/export/excel', [PackingReportController::class, 'exportExcel'])->name('packing.export.excel');
    Route::get('/packing/export/pdf', [PackingReportController::class, 'exportPdf'])->name('packing.export.pdf');
    Route::resource('packing', PackingReportController::class)->except('show');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class)->except('show');
        Route::resource('products', ProductController::class)->except('show');
    });
});
