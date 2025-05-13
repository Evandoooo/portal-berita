<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;


Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/{slug}', [NewsController::class, 'category'])->name('news.category');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
