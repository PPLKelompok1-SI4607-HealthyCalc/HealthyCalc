<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\IntakeHistory;
use App\Http\Requests\StoreIntakeHistoryRequest;
use App\Http\Requests\UpdateIntakeHistoryRequest;

class IntakeHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intakeHistories = IntakeHistory::where('user_id', auth()->id())->get();
        $weeklyCalories = IntakeHistory::selectRaw('SUM(calories) as weekly_calories')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('user_id', auth()->user()->id)
            ->value('weekly_calories');
        $weeklyProtein = IntakeHistory::selectRaw('SUM(protein) as weekly_protein')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('user_id', auth()->user()->id)
            ->value('weekly_protein');
        $weeklyCarbs = IntakeHistory::selectRaw('SUM(carbs) as weekly_carbs')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('user_id', auth()->user()->id)
            ->value('weekly_carbs');
        $weeklyFat = IntakeHistory::selectRaw('SUM(fat) as weekly_fat')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('user_id', auth()->user()->id)
            ->value('weekly_fat');

        // Get target activity goals from user profile
        $userProfile = UserProfile::where('user_id', auth()->id())->first();
        $targetCalories = $userProfile->max_calories ?? 0;
        $targetProtein = $userProfile->max_potein ?? 0;
        $targetCarbs = $userProfile->max_carbs ?? 0;
        $targetFat = $userProfile->max_fat ?? 0;

        $caloriesProgress = $targetCalories ? min(100, round(($weeklyCalories / $targetCalories) * 100, 2)) : 0;
        $proteinProgress = $targetProtein ? min(100, round(($weeklyProtein / $targetProtein) * 100, 2)) : 0;
        $carbsProgress = $targetCarbs ? min(100, round(($weeklyCarbs / $targetCarbs) * 100, 2)) : 0;
        $fatProgress = $targetFat ? min(100, round(($weeklyFat / $targetFat) * 100, 2)) : 0;
        return view('intake-history.index', compact('intakeHistories', 'weeklyCalories','caloriesProgress', 'weeklyProtein', 'proteinProgress', 'weeklyCarbs', 'carbsProgress', 'weeklyFat', 'fatProgress', 'targetCalories', 'targetProtein', 'targetCarbs', 'targetFat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIntakeHistoryRequest $request)
    {
        $validatedData = $request->validate([
            'food_name' => 'required|string',
            'calories' => 'required|numeric',
            'protein' => 'required|numeric',
            'carbs' => 'required|numeric',
            'fat' => 'required|numeric',
            'meal_time' => 'required|in:Sarapan,Makan Siang,Makan Malam,Camilan',
            'consumed_at' => 'nullable|date',
        ]);
        $validatedData['user_id'] = auth()->user()->id;

        IntakeHistory::create($validatedData);

        return redirect()->route('intake-histories.index')->with('success', 'Riwayat Asupan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(IntakeHistory $intakeHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IntakeHistory $intakeHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIntakeHistoryRequest $request, IntakeHistory $intakeHistory)
    {
        $validatedData = $request->validate([
            'food_name' => 'required|string',
            'calories' => 'required|numeric',
            'protein' => 'required|numeric',
            'carbs' => 'required|numeric',
            'fat' => 'required|numeric',
            'meal_time' => 'required|in:Sarapan,Makan Siang,Makan Malam,Camilan',
            'consumed_at' => 'nullable|date',
        ]);

        $intakeHistory->update($validatedData);

        return redirect()->route('intake-histories.index')->with('success', 'Riwayat Asupan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntakeHistory $intakeHistory)
    {
        $intakeHistory->delete();

        return redirect()->route('intake-histories.index')->with('success', 'Riwayat Asupan berhasil dihapus');

    }
}
