<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Filament\Facades\Filament;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/featured-news', [NewsController::class, 'loadFeaturedNews'])->name('news.featured-news');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->name('password.email');

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

Route::post('/news/{news}/comment', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');

Route::get('/{slug}', [NewsController::class, 'category'])->name('news.category');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

