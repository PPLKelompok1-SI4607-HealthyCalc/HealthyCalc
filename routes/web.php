<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NutritionSummaryController;
use App\Http\Controllers\WeightProgressController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FoodChartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplementController;


// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard Routes
Route::get('/dashboard', [NutritionSummaryController::class, 'index'])->name('dashboard');
Route::get('/dashboard/weight-progress', [WeightProgressController::class, 'index'])->name('dashboard.weight_progress');
Route::get('/dashboard/food-chart', [FoodChartController::class, 'index'])->name('dashboard.food_chart');

// Recipe Routes (Fixed)
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
Route::get('/recipes/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::put('/recipes/{id}', [RecipeController::class, 'update'])->name('recipes.update'); 
Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy'); 

// Supplement Routes 
Route::get('/supplements', [SupplementController::class, 'index'])->name('supplements.index');
Route::get('/supplements/create', [SupplementController::class, 'create'])->name('supplements.create');
Route::post('/supplements', [SupplementController::class, 'store'])->name('supplements.store');
Route::get('/supplements/{id}/edit', [SupplementController::class, 'edit'])->name('supplements.edit');
Route::put('/supplements/{id}', [SupplementController::class, 'update'])->name('supplements.update');
Route::delete('/supplements/{id}', [SupplementController::class, 'destroy'])->name('supplements.destroy');



// Profile Routes
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');