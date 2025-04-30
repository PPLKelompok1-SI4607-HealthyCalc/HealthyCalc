<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAnalysisController extends Controller
{
    public function index()
{
    $userId = auth()->id();

    // Ambil data dari database
    $weightProgress = DB::table('weight_progress')
        ->where('user_id', $userId)
        ->orderBy('date', 'desc')
        ->get();

    $calorieIntake = DB::table('calorie_logs')
        ->where('user_id', $userId)
        ->selectRaw('DATE(created_at) as date, SUM(calories) as total_calories')
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->get();

    $physicalActivity = DB::table('activity_logs')
        ->where('user_id', $userId)
        ->orderBy('date', 'desc')
        ->get();

    return view('analysis', compact('weightProgress', 'calorieIntake', 'physicalActivity'));
}

public function update(Request $request)
{
    $request->validate([
        'weight' => 'required|numeric',
        'calories' => 'required|numeric',
        'activity' => 'required|string',
    ]);

    DB::table('weight_progress')->insert([
        'user_id' => auth()->id(),
        'weight' => $request->weight,
        'date' => now(),
    ]);

    DB::table('calorie_logs')->insert([
        'user_id' => auth()->id(),
        'calories' => $request->calories,
        'created_at' => now(),
    ]);

    DB::table('activity_logs')->insert([
        'user_id' => auth()->id(),
        'activity' => $request->activity,
        'date' => now(),
    ]);

    return redirect()->route('dashboard.analysis')->with('success', 'Data berhasil diperbarui!');
}
}