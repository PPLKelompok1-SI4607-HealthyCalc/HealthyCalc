<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodIntakeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Pastikan profil pengguna ada
        $profile = $user->profile;
        if (!$profile) {
            return redirect()->route('profile.create')->with('error', 'Profil pengguna belum dibuat. Silakan lengkapi profil Anda terlebih dahulu.');
        }

        // Ambil data asupan dari database
        $intakes = $user->foodIntakes()->get();

        // Hitung total nutrisi
        $totalCalories = $intakes->sum('calories');
        $totalProtein = $intakes->sum('protein');
        $totalCarbs = $intakes->sum('carbs');
        $totalFat = $intakes->sum('fat');

        // Ambil target nutrisi dari profil (gunakan default jika null)
        $targetCalories = $profile->calorie_limit ?? 2000;
        $targetProtein = $profile->protein_limit ?? 60;
        $targetCarbs = $profile->carbs_limit ?? 300;
        $targetFat = $profile->fat_limit ?? 85;

        // Grupkan asupan berdasarkan waktu makan
        $groupedIntakes = $intakes->groupBy('meal_time');

        // Kirim data ke view
        return view('food_intakes.index', compact(
            'intakes',
            'totalCalories',
            'totalProtein',
            'totalCarbs',
            'totalFat',
            'targetCalories',
            'targetProtein',
            'targetCarbs',
            'targetFat',
            'groupedIntakes'
        ));
    }

    public function create()
    {
        $user = auth()->user();
        $profile = $user->profile;

        return view('food_intakes.create', compact('profile'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'food_name' => 'required|string|max:255',
            'calories' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'carbs' => 'required|numeric|min:0',
            'fat' => 'required|numeric|min:0',
            'meal_time' => 'nullable|string',
            'consumed_at' => 'nullable|date',
        ]);

        // Simpan data ke database
        auth()->user()->foodIntakes()->create([
            'food_name' => $request->food_name,
            'calories' => $request->calories,
            'protein' => $request->protein,
            'carbs' => $request->carbs,
            'fat' => $request->fat,
            'meal_time' => $request->meal_time,
            'consumed_at' => $request->consumed_at,
        ]);

        return redirect()->route('food-intakes.index')->with('success', 'Asupan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $intake = auth()->user()->foodIntakes()->find($id);

        if (!$intake) {
            return redirect()->route('food-intakes.index')->with('error', 'Data makanan tidak ditemukan.');
        }

        return view('food_intakes.edit', compact('intake'));
    }

    public function confirmDelete($id)
    {
        $intake = auth()->user()->foodIntakes()->find($id);

        if (!$intake) {
            return redirect()->route('food-intakes.index')->with('error', 'Data makanan tidak ditemukan.');
        }

        return view('food_intakes.confirm-delete', compact('intake'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'calories' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'carbs' => 'required|numeric|min:0',
            'fat' => 'required|numeric|min:0',
            'meal_time' => 'required|string',
        ]);

        // Cari data berdasarkan ID
        $intake = auth()->user()->foodIntakes()->find($id);

        if (!$intake) {
            return redirect()->route('food-intakes.index')->with('error', 'Data makanan tidak ditemukan.');
        }

        // Update data
        $intake->update($validated);

        return redirect()->route('food-intakes.index')->with('success', 'Data makanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $intake = auth()->user()->foodIntakes()->find($id);

        if (!$intake) {
            return redirect()->route('food-intakes.index')->with('error', 'Data makanan tidak ditemukan.');
        }

        $intake->delete();

        return redirect()->route('food-intakes.index')->with('success', 'Data makanan berhasil dihapus.');
    }
}