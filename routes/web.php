<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NutritionSummaryController;
use App\Http\Controllers\WeightProgressController;
use App\Http\Controllers\FoodChartController;
use App\Http\Controllers\FoodLogController;
use App\Http\Controllers\ProfileController;

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Registrasi
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rute Dashboard
Route::get('/dashboard', [NutritionSummaryController::class, 'index'])->name('dashboard');

// Rute Submenu Dashboard
Route::get('/dashboard/weight-progress', [WeightProgressController::class, 'index'])->name('dashboard.weight_progress');
Route::get('/dashboard/food-chart', [FoodChartController::class, 'index'])->name('dashboard.food_chart');

// Rute Profil
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');

Route::prefix('riwayat-konsumsi-gizi')->group(function () {
    Route::get('/', [FoodLogController::class, 'index'])->name('food_log.index');
    Route::get('/tambah', [FoodLogController::class, 'create'])->name('food_log.create');
    Route::post('/', [FoodLogController::class, 'store'])->name('food_log.store');
    Route::get('/{id}/edit', [FoodLogController::class, 'edit'])->name('food_log.edit');
    Route::put('/{id}', [FoodLogController::class, 'update'])->name('food_log.update');
    Route::delete('/{id}', [FoodLogController::class, 'destroy'])->name('food_log.destroy');
});