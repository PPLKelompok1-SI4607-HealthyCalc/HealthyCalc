<?php

use App\Models\Activity;
use App\Models\TabooFood;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BMRController;
use App\Http\Controllers\CaloryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuplemenController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodChartController;
use App\Http\Controllers\TabooFoodController;
use App\Http\Controllers\FoodIntakeController;
use App\Http\Controllers\FoodPlanningController;
use App\Http\Controllers\IntakeHistoryController;
use App\Http\Controllers\WeightProgressController;
use App\Http\Controllers\NutritionSummaryController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\UserProfileController;
use App\Models\IntakeHistory;

// falback
Route::fallback(function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('communities', CommunityController::class);
    Route::resource('food-plannings', FoodPlanningController::class);
    Route::resource('taboo-foods', TabooFoodController::class);
    Route::post('suplemens/{id}/konsumsi', [SuplemenController::class, 'konsumsi'])->name('suplemens.konsumsi');
    Route::resource('suplemens', SuplemenController::class);
    Route::resource('activities', ActivityController::class);
    Route::resource('user-profiles', UserProfileController::class);
    Route::resource('intake-histories', IntakeHistoryController::class);
    Route::resource('recipes', RecipeController::class);
    Route::resource('calculations', BMRController::class);
    Route::resource('simulations', SimulationController::class);

});


