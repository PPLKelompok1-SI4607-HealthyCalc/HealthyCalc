<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController; // ← ini yang kurang

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
