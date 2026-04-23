<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
// 1. الصفحة الرئيسية تحول فوراً لصفحة الدخول
Route::get('/', function () {
    return redirect('/login');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
});
// مسارات إنشاء حساب جديد

Route::post('/register', [AuthController::class, 'register']);

// 2. تجميع كل مسارات التحديات داخل "مجموعة حماية"
Route::middleware(['auth'])->group(function () {
    
    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('/my-challenges', [ChallengeController::class, 'myChallenges'])->name('challenges.my_challenges');
    Route::post('/challenges/{id}/join', [ChallengeController::class, 'join'])->name('challenges.join');
    Route::post('/challenges/{id}/complete', [ChallengeController::class, 'completeDay'])->name('challenges.complete');

});

// 3. مسارات Auth اليدوية

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/challenges/create', [AdminController::class, 'create'])->name('admin.challenges.create');
    Route::post('/challenges/store', [AdminController::class, 'store'])->name('admin.challenges.store');
});
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/challenges/create', [AdminController::class, 'create'])->name('admin.challenges.create');
    Route::post('/challenges/store', [AdminController::class, 'store'])->name('admin.challenges.store');
});

Route::delete('/challenges/{id}', [AdminController::class, 'destroy'])->name('admin.challenges.destroy');
Route::delete('/challenges/{id}/leave', [ChallengeController::class, 'leave'])->name('challenges.leave')->middleware('auth');
