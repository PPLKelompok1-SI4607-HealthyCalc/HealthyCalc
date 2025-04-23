<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function create()
    {
        return view('profile.profile_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'age' => 'required|integer',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'gender' => 'required',
            'activity_level' => 'required',
            'diet_preferences' => 'nullable|array',
        ]);

        $profile = UserProfile::create([
            'user_id' => Auth::id(),
            'age' => $request->age,
            'height' => $request->height,
            'weight' => $request->weight,
            'gender' => $request->gender,
            'activity_level' => $request->activity_level,
            'diet_preferences' => $request->diet_preferences,
        ]);

        return redirect()->route('dashboard')->with('success', 'Profil berhasil disimpan');
    }
}
