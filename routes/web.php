<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAnalysisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard/analysis', [DashboardAnalysisController::class, 'index'])->name('dashboard.analysis');
Route::post('/dashboard/analysis/update', [DashboardAnalysisController::class, 'update'])->name('dashboard.analysis.update');