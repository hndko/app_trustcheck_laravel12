<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Rute Autentikasi Portal Kelola (Netral tanpa nama role)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Pencarian Utama & Hasil Due Diligence
Route::get('/', [SearchController::class, 'index'])->name('search.index');
Route::post('/search', [SearchController::class, 'process'])->name('search.process');
Route::get('/search/loading/{id}', [SearchController::class, 'loading'])->name('search.loading');
Route::get('/search/status/{id}', [SearchController::class, 'status'])->name('search.status');
Route::get('/search/result/{id}', [SearchController::class, 'result'])->name('search.result');

// Ekspor PDF Laporan Resmi
Route::get('/company/{id}/pdf', [CompanyController::class, 'exportPdf'])->name('company.pdf');

// Komparasi Reputasi Perusahaan
Route::get('/compare', [CompareController::class, 'index'])->name('compare.index');

// Portal Kelola Sistem & Analitik Internal (Dilindungi Auth & Middleware Permission Spatie)
Route::middleware(['auth', 'permission:access_portal_kelola'])->prefix('portal-kelola')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('portal.dashboard');
    Route::resource('faq', FaqController::class)->names('portal.faq');
});
