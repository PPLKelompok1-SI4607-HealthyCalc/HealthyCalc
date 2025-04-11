<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NutritionSummaryController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); 
        $today = now()->toDateString();

        $intake = DB::table('food_logs')
            ->where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->selectRaw('
                SUM(calories) as calories,
                SUM(protein) as protein,
                SUM(carbs) as carbs,
                SUM(fat) as fat
            ')
            ->first();

        $target = DB::table('user_targets')
            ->where('user_id', $userId)
            ->first();

        return view('dashboard.nutrition', compact('intake', 'target'));
    }
}
