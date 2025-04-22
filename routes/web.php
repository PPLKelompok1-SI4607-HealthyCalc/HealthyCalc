<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController; // ← ini yang kurang
use App\Http\Controllers\KaloriNutrisiController;

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/kalori-nutrisi/create', [KaloriNutrisiController::class, 'create'])->name('kalori-nutrisi.create');
