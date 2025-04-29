<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NutritionSummaryController;
use App\Http\Controllers\KaloriController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', [NutritionSummaryController::class, 'index'])->name('dashboard');

Route::get('/dashboard/weight-progress', [WeightProgressController::class, 'index'])->name('dashboard.weight_progress');
use App\Http\Controllers\KaloriNutrisiController;

Route::get('/kalori', [KaloriController::class, 'index'])->name('kalori.index');
Route::post('/kalori/hitung', [KaloriController::class, 'hitung'])->name('kalori.hitung');
Route::get('/kalori/edit', [KaloriController::class, 'edit'])->name('kalori.edit');
Route::get('/kalori/reset', [KaloriController::class, 'reset'])->name('kalori.reset');