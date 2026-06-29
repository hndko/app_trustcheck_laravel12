<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\PortalController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ProviderController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CompanyController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\HealthController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SitemapController;
use Illuminate\Support\Facades\Route;

// SEO Sitemap & Health Check Production
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/up', [HealthController::class, 'index'])->name('health.up');

// Rute Autentikasi Portal Kelola (Netral tanpa nama role)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Pencarian Utama & Hasil Due Diligence
Route::get('/', [SearchController::class, 'index'])->name('search.index');
Route::post('/search', [SearchController::class, 'process'])->middleware('throttle:search')->name('search.process');
Route::get('/search/loading/{id}', [SearchController::class, 'loading'])->name('search.loading');
Route::get('/search/status/{id}', [SearchController::class, 'status'])->name('search.status');
Route::get('/search/result/{id}', [SearchController::class, 'result'])->name('search.result');

// Ekspor PDF & Koreksi Data Laporan Resmi
Route::get('/company/{id}/pdf', [CompanyController::class, 'exportPdf'])->name('company.pdf');
Route::post('/company/{id}/correction', [CompanyController::class, 'storeCorrection'])->name('company.correction');

// Komparasi Reputasi Perusahaan
Route::get('/compare', [CompareController::class, 'index'])->name('compare.index');

// Portal Kelola Sistem & Analitik Internal (Dilindungi Auth & Middleware Permission Spatie)
Route::middleware(['auth', 'permission:access_portal_kelola'])->prefix('portal-kelola')->group(function () {
    Route::get('/', [PortalController::class, 'dashboard'])->name('portal.dashboard');
    Route::resource('faq', FaqController::class)->names('portal.faq');
    
    // Kelola Provider AI Dinamis
    Route::get('/providers', [ProviderController::class, 'index'])->name('portal.providers.index');
    Route::post('/providers', [ProviderController::class, 'update'])->name('portal.providers.update');

    // Manajemen Pengguna & Profil (Dilindungi izin manage_users atau bypass superadmin)
    Route::resource('users', UserController::class)->names('portal.users');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('portal.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('portal.profile.update');
});
