<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NutritionSummaryController;
use App\Http\Controllers\WeightProgressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodIntakeController;

Route::resource('food-intakes', FoodIntakeController::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('food-intakes.index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', [NutritionSummaryController::class, 'index'])->name('dashboard');

Route::get('/dashboard/weight-progress', [WeightProgressController::class, 'index'])->name('dashboard.weight_progress');

Route::middleware(['web'])->group(function () {
    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/create', [ProfileController::class, 'create'])->name('profile.create');
        Route::post('/', [ProfileController::class, 'store'])->name('profile.store');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});






