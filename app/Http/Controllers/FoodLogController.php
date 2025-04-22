<?php

namespace App\Http\Controllers;

use App\Models\FoodLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodLogController extends Controller
{
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
            'user_id' => Auth::id(),
            'food_name' => $request->food_name,
            'portion' => $request->portion,
            'calories' => $request->calories,
            'protein' => $request->protein,
            'carbs' => $request->carbs,
            'fat' => $request->fat,
            'consumed_at' => $request->consumed_at,
        ]);

        return redirect()->route('dashboard')->with('success', 'Makanan berhasil ditambahkan!');
    }
}
