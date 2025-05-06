<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodLog;

class NutritionSummaryController extends Controller
{
    public function index()
    {
        $foodLogs = FoodLog::orderBy('consumed_at', 'desc')->take(5)->get();
        $summary = FoodLog::selectRaw('SUM(calories) as total_calories, SUM(protein) as total_protein, SUM(carbs) as total_carbs, SUM(fat) as total_fat')->first();

        return view('dashboard.index', compact('foodLogs', 'summary'));
    }
}