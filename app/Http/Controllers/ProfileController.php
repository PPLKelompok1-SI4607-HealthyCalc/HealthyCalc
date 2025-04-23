<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Menampilkan form create profile
    public function create()
    {
        $user = Auth::user();
        return view('profile.profile_create', compact('user'));
    }

    // Menyimpan data profile ke database
    public function store(Request $request)
    {
        $request->validate([
            'age' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'gender' => 'required|in:male,female',
            'activity_level' => 'required',
            'diet_preferences' => 'nullable|array',
            'photo' => 'nullable|image|max:2048'
        ]);

        $user = Auth::user();

        $data = $request->only([
            'age',
            'height',
            'weight',
            'gender',
            'activity_level',
            'diet_preferences'
        ]);

        $data['user_id'] = $user->id;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('profile_photos', 'public');
        }

        UserProfile::create($data);

        return redirect()->route('dashboard')->with('success', 'Profil berhasil disimpan!');

    }
}
