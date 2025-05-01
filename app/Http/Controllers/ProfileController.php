<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserProfile;

class ProfileController extends Controller
{
    public function create()
    {
        if (Session::has('user_id') && UserProfile::where('user_id', Session::get('user_id'))->exists()) {
            return redirect()->route('profile.show');
        }
        return view('profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|string|in:Laki-laki,Perempuan,Lainnya',
            'height' => 'required|integer|min:50|max:250',
            'weight' => 'required|numeric|min:20|max:300',
            'activity_level' => 'required|string|in:Sangat Aktif,Cukup Aktif,Kurang Aktif',
            'diet' => 'nullable|array',
            'diet.*' => 'string|in:Vegetarian,Rendah Kalori,Bebas gluten',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->email,
            'password' => bcrypt('dummy_password'),
        ]);

        // Create profile
        $user->profile()->create([
            'age' => $request->age,
            'gender' => $request->gender,
            'height' => $request->height,
            'weight' => $request->weight,
            'activity_level' => $request->activity_level,
            'is_vegetarian' => in_array('Vegetarian', $request->diet ?? []),
            'is_low_calorie' => in_array('Rendah Kalori', $request->diet ?? []),
            'is_gluten_free' => in_array('Bebas gluten', $request->diet ?? []),
            'profile_photo_path' => $photoPath,
        ]);

        Session::put('user_id', $user->id);
        
        return redirect()->route('profile.show')->with('success', 'Profil berhasil dibuat');
    }

    public function show()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('profile.create');
        }
        
        $user = User::with('profile')->find(Session::get('user_id'));
        
        if (!$user || !$user->profile) {
            return redirect()->route('profile.create');
        }

        return view('profile.show', ['profile' => $user]);
    }

    public function edit()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('profile.create');
        }
        
        $user = User::with('profile')->find(Session::get('user_id'));
        
        if (!$user || !$user->profile) {
            return redirect()->route('profile.create');
        }

        return view('profile.edit', ['profile' => $user]);
    }

    public function update(Request $request)
    {
        if (!Session::has('user_id')) {
            return redirect()->route('profile.create');
        }
        
        $user = User::with('profile')->find(Session::get('user_id'));
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|string|in:Laki-laki,Perempuan,Lainnya',
            'height' => 'required|integer|min:50|max:250',
            'weight' => 'required|numeric|min:20|max:300',
            'activity_level' => 'required|string|in:Sangat Aktif,Cukup Aktif,Kurang Aktif',
            'diet' => 'nullable|array',
            'diet.*' => 'string|in:Vegetarian,Rendah Kalori,Bebas gluten',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile->profile_photo_path) {
                Storage::disk('public')->delete($user->profile->profile_photo_path);
            }
            
            $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile->profile_photo_path = $photoPath;
            $user->profile->save();
        }

        // Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->email,
        ]);

        // Update profile
        $user->profile()->update([
            'age' => $request->age,
            'gender' => $request->gender,
            'height' => $request->height,
            'weight' => $request->weight,
            'activity_level' => $request->activity_level,
            'is_vegetarian' => in_array('Vegetarian', $request->diet ?? []),
            'is_low_calorie' => in_array('Rendah Kalori', $request->diet ?? []),
            'is_gluten_free' => in_array('Bebas gluten', $request->diet ?? []),
        ]);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui');
    }

    public function destroy()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('profile.create');
        }
        
        $user = User::with('profile')->find(Session::get('user_id'));
        
        if ($user) {
            // Delete profile photo if exists
            if ($user->profile && $user->profile->profile_photo_path) {
                Storage::disk('public')->delete($user->profile->profile_photo_path);
            }
            
            $user->profile()->delete();
            $user->delete();
        }

        Session::forget('user_id');
        return redirect()->route('profile.create')->with('success', 'Profil berhasil dihapus');
    }
}