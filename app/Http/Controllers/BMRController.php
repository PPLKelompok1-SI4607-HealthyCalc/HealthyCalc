<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

class BMRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userProfile = UserProfile::where('user_id', auth()->id())->first();
        return view('calculation.index', compact('userProfile'));
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
    public function store(Request $request)
    {
        
        // Validasi input
        $request->validate([
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'height' => 'required|integer|min:50|max:250',
            'weight' => 'required|numeric|min:20|max:300',
            'activity_level' => 'required|string|in:Sangat Aktif,Cukup Aktif,Kurang Aktif',
        ]);

        // Perhitungan kalori
        $bmr = $request->gender === 'Laki-laki'
            ? 88.36 + (13.4 * $request->weight) + (4.8 * $request->height) - (5.7 * $request->age)
            : 447.6 + (9.2 * $request->weight) + (3.1 * $request->height) - (4.3 * $request->age);

        $activity_multiplier = match ($request->activity_level) {
            'Sangat Aktif' => 1.9,
            'Cukup Aktif' => 1.55,
            'Kurang Aktif' => 1.2,
        };

        $calories = $bmr * $activity_multiplier;

        // Distribusi nutrisi
        $protein_calories = $calories * 0.25; // 25% dari kalori untuk protein
        $carbs_calories = $calories * 0.50; // 50% dari kalori untuk karbohidrat
        $fat_calories = $calories * 0.25; // 25% dari kalori untuk lemak

        $protein = $protein_calories / 4; // 1 gram protein = 4 kalori
        $carbs = $carbs_calories / 4; // 1 gram karbohidrat = 4 kalori
        $fat = $fat_calories / 9; // 1 gram lemak = 9 kalori

        // Update UserProfile
        UserProfile::where('user_id', auth()->id())->update([
            'max_calories' => $calories,
            'max_potein' => $protein,
            'max_carbs' => $carbs,
            'max_fat' => $fat,
        ]);

        return view('calculation.show', compact('calories', 'protein', 'carbs', 'fat'));
       
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
