<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with('user')->where('user_id', auth()->user()->id)->latest()->get();
        $weeklyCalories = Activity::selectRaw('SUM(calories_burned) as weekly_calories')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('user_id', auth()->user()->id)
            ->value('weekly_calories');
        $weeklyActivities = Activity::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('user_id', auth()->user()->id)
            ->count();
        $weeklyMinutes = Activity::selectRaw('SUM(duration_minutes) as weekly_hours')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where('user_id', auth()->user()->id)
            ->value('weekly_hours');

        // Default target activity goals
        $targetCalories = 1500; // kalori
        $targetMinutes = 300;   // menit
        $targetActivities = 5;  // aktivitas

        $caloriesProgress = min(100, round(($weeklyCalories / $targetCalories) * 100, 2));
        $minutesProgress = min(100, round(($weeklyMinutes / $targetMinutes) * 100, 2));
        $activitiesProgress = min(100, round(($weeklyActivities / $targetActivities) * 100, 2));

        return view('activity.index', compact('activities', 'weeklyCalories', 'weeklyActivities', 'weeklyMinutes', 'caloriesProgress', 'minutesProgress', 'activitiesProgress'));
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
    public function store(StoreActivityRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        Activity::create($validatedData);
        return redirect()->route('activities.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $validatedData = $request->validated();
        $activity->update($validatedData);
        return redirect()->route('activities.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Data berhasil dihapus');
    }
}
