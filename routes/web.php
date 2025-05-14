<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightProgressController;
use App\Http\Controllers\FoodChartController;
use App\Http\Controllers\FoodLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FoodIntakeController;
use App\Http\Controllers\KaloriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SimulasiDefisitController;
use App\Http\Controllers\CommunityPostController;


// Rute Profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); // memastikan PUT method
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Rute yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Redirect root URL to dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Submenu Dashboard
    Route::get('/dashboard/weight-progress', [WeightProgressController::class, 'index'])->name('dashboard.weight_progress');
    Route::get('/dashboard/food-chart', [FoodChartController::class, 'index'])->name('dashboard.food_chart');

    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Riwayat Konsumsi Gizi (Food Log)
    Route::prefix('riwayat-konsumsi-gizi')->group(function () {
        Route::get('/', [FoodLogController::class, 'index'])->name('food_log.index');
        Route::get('/tambah', [FoodLogController::class, 'create'])->name('food_log.create');
        Route::post('/', [FoodLogController::class, 'store'])->name('food_log.store');
        Route::get('/{id}/edit', [FoodLogController::class, 'edit'])->name('food_log.edit');
        Route::put('/{id}', [FoodLogController::class, 'update'])->name('food_log.update');
        Route::delete('/{id}', [FoodLogController::class, 'destroy'])->name('food_log.destroy');
    });

    // Rute Resep Makanan
    Route::resource('recipes', RecipeController::class);

    // Rute Food Intakes
    Route::prefix('food-intakes')->group(function () {
        Route::get('/', [FoodIntakeController::class, 'index'])->name('food-intakes.index');
        Route::get('/create', [FoodIntakeController::class, 'create'])->name('food-intakes.create');
        Route::post('/', [FoodIntakeController::class, 'store'])->name('food-intakes.store');
        Route::get('/{id}/edit', [FoodIntakeController::class, 'edit'])->name('food-intakes.edit');
        Route::put('/{id}', [FoodIntakeController::class, 'update'])->name('food-intakes.update');
        Route::delete('/{id}', [FoodIntakeController::class, 'destroy'])->name('food-intakes.destroy');
        Route::get('/{id}/confirm-delete', [FoodIntakeController::class, 'confirmDelete'])->name('food-intakes.confirm-delete');
    });

    // Rute Kalori
    Route::get('/kalori', [KaloriController::class, 'index'])->name('kalori.index');
    Route::post('/kalori/hitung', [KaloriController::class, 'hitung'])->name('kalori.hitung');
    Route::get('/kalori/edit', [KaloriController::class, 'edit'])->name('kalori.edit');
    Route::get('/kalori/reset', [KaloriController::class, 'reset'])->name('kalori.reset');
    Route::post('/kalori/store', [KaloriController::class, 'store'])->name('kalori.store');
    Route::put('/kalori/update', [KaloriController::class, 'update'])->name('kalori.update');
    Route::get('/kalori/result', [KaloriController::class, 'result'])->name('kalori.result');

    // Rute Simulasi Defisit Kalori
    Route::resource('simulasi-defisit', SimulasiDefisitController::class);
    Route::get('/simulasi-defisit', [SimulasiDefisitController::class, 'index'])->name('simulasi-defisit.index');
    Route::post('/simulasi-defisit/hitung', [SimulasiDefisitController::class, 'hitung'])->name('simulasi-defisit.hitung');

    

    Route::get('/community/create', [CommunityPostController::class, 'create'])->name('community.create');
    Route::post('/community', [CommunityPostController::class, 'store'])->name('community.store');
    Route::get('/community', [CommunityPostController::class, 'index'])->name('community.index');
    Route::get('/community/{id}', [CommunityPostController::class, 'show'])->name('community.show');
    Route::get('/community/{id}/edit', [CommunityPostController::class, 'edit'])->name('community.edit');
    Route::put('/community/{id}', [CommunityPostController::class, 'update'])->name('community.update');
    Route::delete('/community/{id}', [CommunityPostController::class, 'destroy'])->name('community.destroy');
});