<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function create()
    {
        // Check if user is already logged in and has a profile
        if (Session::has('user_id') && UserProfile::where('user_id', Session::get('user_id'))->exists()) {
            return redirect()->route('profile.show');
        }
        return view('profile.create');
    }

    public function store(Request $request)
    {
        // Tambahkan debugging
        \Illuminate\Support\Facades\Log::info('Store method called');
        
        $validated = $request->validate([
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

        \Illuminate\Support\Facades\Log::info('Validation passed', $validated);

        try {
            // Use a simpler approach without transaction first
            // Create user
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->username = $validated['email'];
            $user->password = bcrypt(Str::random(16));
            $user->save();
            
            \Illuminate\Support\Facades\Log::info('User created with ID: ' . $user->id);

            // Handle file upload
            $photoPath = null;
            if ($request->hasFile('profile_photo')) {
                $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
                \Illuminate\Support\Facades\Log::info('Photo uploaded: ' . $photoPath);
            }

            // Create profile directly
            $profile = new UserProfile();
            $profile->user_id = $user->id;
            $profile->age = $validated['age'];
            $profile->gender = $validated['gender'];
            $profile->height = $validated['height'];
            $profile->weight = $validated['weight'];
            $profile->activity_level = $validated['activity_level'];
            $profile->is_vegetarian = in_array('Vegetarian', $validated['diet'] ?? []);
            $profile->is_low_calorie = in_array('Rendah Kalori', $validated['diet'] ?? []);
            $profile->is_gluten_free = in_array('Bebas gluten', $validated['diet'] ?? []);
            $profile->profile_photo_path = $photoPath;
            $profile->save();
            
            \Illuminate\Support\Facades\Log::info('Profile created');

            // Store user ID in session
            $request->session()->put('user_id', $user->id);
            $request->session()->save(); // Force session save
            
            \Illuminate\Support\Facades\Log::info('Session saved with user_id: ' . $user->id);
            \Illuminate\Support\Facades\Log::info('Current session contains: ' . json_encode(session()->all()));

            return redirect()->route('profile.show')->with('success', 'Profil berhasil dibuat!');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error creating profile: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error($e->getTraceAsString());
            return back()->withInput()->with('error', 'Gagal membuat profil: ' . $e->getMessage());
        }
    }

    public function show()
    {
        \Illuminate\Support\Facades\Log::info('Show method called');
        \Illuminate\Support\Facades\Log::info('Session contents: ' . json_encode(session()->all()));
        
        // Check if session exists
        if (!session()->has('user_id')) {
            \Illuminate\Support\Facades\Log::warning('No user_id in session');
            return redirect()->route('profile.create');
        }
        
        $userId = session('user_id');
        \Illuminate\Support\Facades\Log::info('User ID from session: ' . $userId);
        
        // Debug session driver and configuration
        \Illuminate\Support\Facades\Log::info('Session driver: ' . config('session.driver'));
        \Illuminate\Support\Facades\Log::info('Session cookie name: ' . config('session.cookie'));
        
        $user = User::with('profile')->find($userId);
        
        if (!$user) {
            \Illuminate\Support\Facades\Log::warning('User not found in database with ID: ' . $userId);
            session()->forget('user_id');
            return redirect()->route('profile.create')
                ->with('error', 'User tidak ditemukan. Silakan buat profil baru.');
        }
        
        if (!$user->profile) {
            \Illuminate\Support\Facades\Log::warning('Profile not found for user ID: ' . $userId);
            
            // Don't clear session, let's try to recover
            return redirect()->route('profile.create')
                ->with('error', 'Profil tidak ditemukan. Silakan buat profil baru.');
        }

        \Illuminate\Support\Facades\Log::info('User and profile found, rendering view');
        return view('profile.show', ['profile' => $user]);
    }

    public function edit()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('profile.create');
        }
        
        $user = User::with('profile')->find(session('user_id'));
        
        if (!$user || !$user->profile) {
            session()->forget('user_id');
            return redirect()->route('profile.create');
        }

        return view('profile.edit', ['profile' => $user]);
    }

    public function update(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('profile.create');
        }
        
        $user = User::with('profile')->find(session('user_id'));
        
        if (!$user) {
            session()->forget('user_id');
            return redirect()->route('profile.create');
        }
        
        $validated = $request->validate([
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

        try {
            DB::beginTransaction();

            // Handle file upload
            $photoPath = $user->profile->profile_photo_path;
            if ($request->hasFile('profile_photo')) {
                // Delete old photo if exists
                if ($photoPath) {
                    Storage::disk('public')->delete($photoPath);
                }
                $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
            }

            // Update user
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'username' => $validated['email'],
            ]);

            // Update profile
            $user->profile()->update([
                'age' => $validated['age'],
                'gender' => $validated['gender'],
                'height' => $validated['height'],
                'weight' => $validated['weight'],
                'activity_level' => $validated['activity_level'],
                'is_vegetarian' => in_array('Vegetarian', $validated['diet'] ?? []),
                'is_low_calorie' => in_array('Rendah Kalori', $validated['diet'] ?? []),
                'is_gluten_free' => in_array('Bebas gluten', $validated['diet'] ?? []),
                'profile_photo_path' => $photoPath,
            ]);

            DB::commit();

            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

    public function destroy()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('profile.create');
        }
        
        $user = User::with('profile')->find(session('user_id'));
        
        if (!$user) {
            session()->forget('user_id');
            return redirect()->route('profile.create');
        }
        
        try {
            DB::beginTransaction();

            // Delete profile photo if exists
            if ($user->profile && $user->profile->profile_photo_path) {
                Storage::disk('public')->delete($user->profile->profile_photo_path);
            }
            
            $user->profile()->delete();
            $user->delete();

            DB::commit();

            session()->forget('user_id');
            return redirect()->route('profile.create')->with('success', 'Profil berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus profil: ' . $e->getMessage());
        }
    }
}