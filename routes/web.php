<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Filament\Facades\Filament;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth', 'is_admin'])->prefix('admin')->group(function () {
    \Filament\Facades\Filament::registerPanel(...);
});

Route::get('/search', [NewsController::class, 'search'])->name('news.search');

Route::middleware('auth')->group(function () {
    Route::post('/news/{news}/save', [NewsController::class, 'save'])->name('news.save');
    Route::delete('/news/{news}/unsave', [NewsController::class, 'unsave'])->name('news.unsave');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
});

Route::get('/{slug}', [NewsController::class, 'category'])->name('news.category');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
