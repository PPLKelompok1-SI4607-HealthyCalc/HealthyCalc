<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan halaman profil pengguna untuk diedit
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile; // Mengambil profil yang terkait dengan pengguna

        return view('profile.edit', compact('user', 'profile'));
    }

    // Menyimpan profil pengguna baru
    public function store(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'age' => 'nullable|integer|min:1|max:120',
            'gender' => 'nullable|string|in:Laki-laki,Perempuan',
            'height' => 'nullable|integer|min:50|max:250',
            'weight' => 'nullable|numeric|min:20|max:300',
            'activity_level' => 'nullable|string|in:Sangat Aktif,Cukup Aktif,Kurang Aktif',
            'diet' => 'nullable|array',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menyimpan profil pengguna
        $profile = new UserProfile();
        $profile->user_id = Auth::id();
        $profile->age = $request->age;
        $profile->gender = $request->gender;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->activity_level = $request->activity_level;
        $profile->is_vegetarian = in_array('Vegetarian', $request->diet ?? []);
        $profile->is_low_calorie = in_array('Rendah Kalori', $request->diet ?? []);
        $profile->is_gluten_free = in_array('Bebas gluten', $request->diet ?? []);

        // Menyimpan foto profil jika ada
        if ($request->hasFile('profile_photo')) {
            $profile->profile_photo_path = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $profile->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil disimpan');
    }

    // Memperbarui profil pengguna
    public function update(Request $request)
    {
        // Validasi inputan
        $validated = $request->validate([
            'age' => 'nullable|integer|min:1|max:120',
            'gender' => 'nullable|string|in:Laki-laki,Perempuan',
            'height' => 'nullable|integer|min:50|max:250',
            'weight' => 'nullable|numeric|min:20|max:300',
            'activity_level' => 'nullable|string|in:Sangat Aktif,Cukup Aktif,Kurang Aktif',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update profil pengguna
        $profile = Auth::user()->profile;
        $profile->age = $request->age;
        $profile->gender = $request->gender;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->activity_level = $request->activity_level;

        // Menyimpan foto profil baru jika ada
        if ($request->hasFile('profile_photo_path')) {
            // Hapus foto lama jika ada
            if ($profile->profile_photo_path && Storage::exists('public/' . $profile->profile_photo_path)) {
                Storage::delete('public/' . $profile->profile_photo_path);
            }
            $profile->profile_photo_path = $request->file('profile_photo_path')->store('profile_photos', 'public');
        }

        $profile->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui');
    }

    // Menampilkan profil pengguna
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile; // Mengambil profil yang terkait dengan pengguna

        return view('profile.show', compact('user', 'profile'));
    }
}
