<?php

namespace App\Http\Controllers;

use App\Models\FoodLog;
use Illuminate\Http\Request;

class FoodLogController extends Controller
{
    public function index()
    {
        // Calculate daily totals from all food logs
        $totalCalories = FoodLog::all()->sum('calories');
        $totalProtein = FoodLog::all()->sum('protein');
        $totalCarbs = FoodLog::all()->sum('carbs');
        $totalFat = FoodLog::all()->sum('fat');

        // Data intake harian
        $intake = (object)[
            'calories' => $totalCalories,
            'protein' => $totalProtein,
            'carbs' => $totalCarbs,
            'fat' => $totalFat,
        ];

        // Target yang ingin dicapai
        $target = (object)[
            'calories' => 2000,
            'protein' => 80,
            'carbs' => 300,
            'fat' => 55,
        ];

        // Get all food logs sorted by consumed_at
        $foodLogs = FoodLog::all()->sortByDesc('consumed_at');

        // Pagination manual
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $paginatedFoodLogs = $foodLogs->forPage($currentPage, $perPage);
        $total = $foodLogs->count();
        $totalPages = ceil($total / $perPage);

        return view('food_log.index', compact('intake', 'target', 'paginatedFoodLogs', 'totalPages', 'currentPage'));
    }

    public function create()
    {
        return view('food_log.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_name' => 'required|string|max:255',
            'portion' => 'required|string|max:100',
            'calories' => 'required|numeric',
            'protein' => 'required|numeric',
            'carbs' => 'required|numeric',
            'fat' => 'required|numeric',
            'consumed_at' => 'required|date',
        ]);

        FoodLog::create([
            'food_name' => $request->food_name,
            'portion' => $request->portion,
            'calories' => $request->calories,
            'protein' => $request->protein,
            'carbs' => $request->carbs,
            'fat' => $request->fat,
            'consumed_at' => $request->consumed_at,
        ]);

        return redirect()->route('food_log.index')->with('success', 'Makanan berhasil ditambahkan!');
    }

    public function edit($index)
    {
        $foodLog = FoodLog::find($index);
        return view('food_log.edit', compact('foodLog', 'index'));
    }

    public function update(Request $request, $index)
    {
        $request->validate([
            'food_name' => 'required|string|max:255',
            'portion' => 'required|string|max:100',
            'calories' => 'required|numeric',
            'protein' => 'required|numeric',
            'carbs' => 'required|numeric',
            'fat' => 'required|numeric',
            'consumed_at' => 'required|date',
        ]);

        $foodLog = FoodLog::find($index);
        if ($foodLog) {
            $foodLog->food_name = $request->food_name;
            $foodLog->portion = $request->portion;
            $foodLog->calories = $request->calories;
            $foodLog->protein = $request->protein;
            $foodLog->carbs = $request->carbs;
            $foodLog->fat = $request->fat;
            $foodLog->consumed_at = $request->consumed_at;
        }

        return redirect()->route('food_log.index')->with('success', 'Makanan berhasil diperbarui!');
    }

    public function destroy($index)
    {
        FoodLog::delete($index);
        return redirect()->route('food_log.index')->with('success', 'Makanan berhasil dihapus!');
    }
}