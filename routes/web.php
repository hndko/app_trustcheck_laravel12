<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SearchController::class, 'index'])->name('search.index');
Route::post('/search', [SearchController::class, 'process'])->name('search.process');
Route::get('/search/loading/{id}', [SearchController::class, 'loading'])->name('search.loading');
Route::get('/search/status/{id}', [SearchController::class, 'status'])->name('search.status');
Route::get('/search/result/{id}', [SearchController::class, 'result'])->name('search.result');
