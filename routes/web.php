<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

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

// Panel Admin & Analitik Internal
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
