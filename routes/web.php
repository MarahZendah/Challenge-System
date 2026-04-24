<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BadgeController;


Route::get('/', function () {
    return redirect('/login');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('/my-challenges', [ChallengeController::class, 'myChallenges'])->name('challenges.my_challenges');
    Route::post('/challenges/{id}/join', [ChallengeController::class, 'join'])->name('challenges.join');
    Route::post('/challenges/{id}/complete', [ChallengeController::class, 'complete'])->name('challenges.complete');
    Route::delete('/challenges/{id}/leave', [ChallengeController::class, 'leave'])->name('challenges.leave');
    Route::get('/my-badges', [BadgeController::class, 'myBadges'])->name('badges.index');
});
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/challenges/create', [AdminController::class, 'create'])->name('admin.challenges.create');
    Route::post('/challenges/store', [AdminController::class, 'store'])->name('admin.challenges.store');
    Route::delete('/challenges/{id}', [AdminController::class, 'destroy'])->name('admin.challenges.destroy');
    Route::get('/badges', [BadgeController::class, 'index'])->name('admin.badges.index');
    Route::post('/badges/store', [BadgeController::class, 'store'])->name('admin.badges.store');
    
Route::get('/badges/{id}/edit', [BadgeController::class, 'edit'])->name('admin.badges.edit');
Route::put('/badges/{id}', [BadgeController::class, 'update'])->name('admin.badges.update');
Route::delete('/badges/{id}', [BadgeController::class, 'destroy'])->name('admin.badges.destroy');
Route::get('/challenges/{id}/edit', [AdminController::class, 'edit'])->name('admin.challenges.edit');
    Route::put('/challenges/{id}', [AdminController::class, 'update'])->name('admin.challenges.update');
});
