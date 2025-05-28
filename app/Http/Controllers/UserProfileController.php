<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userProfile = UserProfile::where('user_id', auth()->id())->first();
        return view('user-profile.index', compact('userProfile'));
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
    public function store(StoreUserProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        $userProfile = UserProfile::where('user_id', auth()->id())->first();
        return view('user-profile.show', compact('userProfile'));
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
    public function update(UpdateUserProfileRequest $request, UserProfile $userProfile)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'height' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'activity_level' => 'required|in:Sangat Aktif,Cukup Aktif,Kurang Aktif',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Tangani upload file dahulu
        if ($request->file('photo')) {
            $filename = time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('img'), $filename);
            $validateData['photo'] = $filename; // Masukkan photo ke data yang akan diupdate
        }

        // Update user_profile
        $userProfile->update($validateData);

        // Update nama di tabel users
        $userProfile->user->update([
            'name' => $request->name
        ]);

        return redirect()->route('user-profiles.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
