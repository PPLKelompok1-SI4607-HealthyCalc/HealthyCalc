<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FoodLog;

class NutritionSummaryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $today = now()->toDateString();

        $intake = DB::table('food_logs')
            ->where('user_id', $userId)
            ->whereDate('consumed_at', $today)
            ->selectRaw('SUM(calories) as calories, SUM(protein) as protein, SUM(carbs) as carbs, SUM(fat) as fat')
            ->first();

        $foodLogs = FoodLog::where('user_id', $userId)
            ->whereDate('consumed_at', $today)
            ->orderBy('consumed_at', 'asc')
            ->get();

        // Dummy target bisa diganti dengan DB nanti
        $target = (object)[
            'calories' => 2000,
            'protein' => 80,
            'carbs' => 300,
            'fat' => 65,
        ];

        return view('dashboard.nutrition', compact('intake', 'target', 'foodLogs'));
    }
}
