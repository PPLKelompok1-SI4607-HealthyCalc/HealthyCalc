<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Activity;
use App\Models\Dashboard;
use App\Models\TabooFood;
use App\Models\UserProfile;
use App\Models\FoodPlanning;
use App\Models\IntakeHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // Get activity data
        $activities = Activity::with('user')->where('user_id', auth()->user()->id)->latest()->get();
        $weeklyCaloriesi = Activity::selectRaw('SUM(calories_burned) as weekly_calories')
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
        $targetCaloriesi = 1500; // kalori
        $targetMinutes = 300;   // menit
        $targetActivities = 5;  // aktivitas

        $caloriesProgressi = min(100, round(($weeklyCaloriesi / $targetCaloriesi) * 100, 2));
        $minutesProgress = min(100, round(($weeklyMinutes / $targetMinutes) * 100, 2));
        $activitiesProgress = min(100, round(($weeklyActivities / $targetActivities) * 100, 2));


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

        $tabooFoods = TabooFood::with('user')->where('user_id', auth()->id())->get();
        // Mengelompokkan dan menghitung jumlah masing-masing kategori taboo
        $tabooCounts = TabooFood::select('taboo', DB::raw('count(*) as total'))
            ->where('user_id', auth()->id())
            ->groupBy('taboo')
            ->pluck('total', 'taboo'); 

        $foodPlannings = FoodPlanning::with('user')->where('user_id', auth()->id())->latest()->get();
        return view('dashboard', compact('foodPlannings','tabooFoods', 'tabooCounts','user', 'activities', 'weeklyCaloriesi', 'weeklyActivities', 'weeklyMinutes', 'caloriesProgress', 'minutesProgress', 'activitiesProgress', 'intakeHistories', 'weeklyCalories','caloriesProgressi', 'weeklyProtein', 'proteinProgress', 'weeklyCarbs', 'carbsProgress', 'weeklyFat', 'fatProgress', 'targetCalories', 'targetCaloriesi', 'targetProtein', 'targetCarbs', 'targetFat', 'tabooFoods', 'foodPlannings'));
    
        
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
    public function store(StoreDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDashboardRequest $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}