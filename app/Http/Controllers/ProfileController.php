<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    private $dummyProfile = [
        'name' => 'Yesitra Anugrah',
        'email' => 'yesi@example.com',
        'age' => 21,
        'gender' => 'Perempuan',
        'height' => 155,
        'weight' => 55,
        'activity_level' => 'Cukup Aktif',
        'diet_preferences' => ['Vegetarian', 'Bebas gluten'],
    ];

    public function create()
    {
        if (Session::has('profile')) {
            return redirect()->route('profile.show');
        }
        return view('profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|string|in:Laki-laki,Perempuan,Lainnya',
            'height' => 'required|integer|min:50|max:250',
            'weight' => 'required|numeric|min:20|max:300',
            'activity_level' => 'required|string|in:Sangat Aktif,Cukup Aktif,Kurang Aktif',
            'diet' => 'nullable|array',
            'diet.*' => 'string|in:Vegetarian,Rendah Kalori,Bebas gluten',
        ]);

        $profileData = [
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'gender' => $request->gender,
            'height' => $request->height,
            'weight' => $request->weight,
            'activity_level' => $request->activity_level,
            'diet_preferences' => $request->diet ?? [],
        ];

        Session::put('profile', $profileData);
        
        return redirect()->route('profile.show')->with('success', 'Profil berhasil dibuat');
    }

    public function show()
    {
        if (!Session::has('profile')) {
            return redirect()->route('profile.create');
        }
        
        $profile = (object)Session::get('profile', $this->dummyProfile);
        return view('profile.show', compact('profile'));
    }

    public function edit()
    {
        if (!Session::has('profile')) {
            return redirect()->route('profile.create');
        }
        
        $profile = (object)Session::get('profile');
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|string|in:Laki-laki,Perempuan,Lainnya',
            'height' => 'required|integer|min:50|max:250',
            'weight' => 'required|numeric|min:20|max:300',
            'activity_level' => 'required|string|in:Sangat Aktif,Cukup Aktif,Kurang Aktif',
            'diet' => 'nullable|array',
            'diet.*' => 'string|in:Vegetarian,Rendah Kalori,Bebas gluten',
        ]);

        $profileData = [
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'gender' => $request->gender,
            'height' => $request->height,
            'weight' => $request->weight,
            'activity_level' => $request->activity_level,
            'diet_preferences' => $request->diet ?? [],
        ];

        Session::put('profile', $profileData);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui');
    }

    public function destroy()
    {
        Session::forget('profile');
        return redirect()->route('profile.create')->with('success', 'Profil berhasil dihapus');
    }
}