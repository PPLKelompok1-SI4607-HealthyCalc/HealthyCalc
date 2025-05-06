<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulasiDefisit;
use Illuminate\Support\Facades\Auth;

class SimulasiDefisitController extends Controller
{
    public function index()
    {
        $simulasi = SimulasiDefisit::all();
        return view('simulasi-defisit.index', compact('simulasi'));
    }

    public function create()
    {
        return view('simulasi-defisit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'target_berat' => 'required|numeric|min:1',
            'durasi' => 'required|integer|min:1',
            'tingkat_aktivitas' => 'required|string',
        ]);

        // Hitung kebutuhan kalori
        $kebutuhanKalori = $this->calculateCalories($validated['target_berat'], $validated['durasi'], $validated['tingkat_aktivitas']);

        // Simpan ke database
        SimulasiDefisit::create([
            'user_id' => Auth::id(),
            'target_berat' => $validated['target_berat'],
            'durasi' => $validated['durasi'],
            'tingkat_aktivitas' => $validated['tingkat_aktivitas'],
            'kebutuhan_kalori' => $kebutuhanKalori, // Pastikan kebutuhan_kalori disimpan
        ]);

        return redirect()->route('simulasi-defisit.index')
            ->with('success', 'Simulasi berhasil disimpan!');
    }

    public function edit(SimulasiDefisit $simulasiDefisit)
    {
        return view('simulasi-defisit.edit', compact('simulasiDefisit'));
    }

    public function update(Request $request, SimulasiDefisit $simulasiDefisit)
    {
        $data = $request->validate([
            'target_berat' => 'required|numeric|min:1', // Tambahkan validasi untuk target_berat
            'durasi' => 'required|integer|min:1',
            'tingkat_aktivitas' => 'required|string',
        ]);

        $data['kebutuhan_kalori'] = $this->calculateCalories($data['target_berat'], $data['durasi'], $data['tingkat_aktivitas']);

        $simulasiDefisit->update($data);

        return redirect()->route('simulasi-defisit.index')
            ->with('success', 'Simulasi berhasil diperbarui!');
    }

    public function destroy(SimulasiDefisit $simulasiDefisit)
    {
        $simulasiDefisit->delete();
        return redirect()->route('simulasi-defisit.index');
    }

    public function hitung(Request $request)
    {
        $validated = $request->validate([
            'current_weight' => 'required|numeric|min:1',
            'target_weight' => 'required|numeric|min:1',
            'time_frame' => 'required|numeric|min:1',
        ]);

        $currentWeight = $validated['current_weight'];
        $targetWeight = $validated['target_weight'];
        $timeFrame = $validated['time_frame'];

        // Hitung defisit kalori
        $weightDifference = $currentWeight - $targetWeight;
        $calorieDeficitPerDay = ($weightDifference * 7700) / ($timeFrame * 7);

        // Simpan ke database
        SimulasiDefisit::create([
            'user_id' => Auth::id(), // ID pengguna yang login
            'current_weight' => $currentWeight,
            'target_weight' => $targetWeight,
            'time_frame' => $timeFrame,
            'durasi' => $timeFrame * 7, // Pastikan durasi dihitung dan disimpan
            'calorie_deficit_per_day' => round($calorieDeficitPerDay, 2),
        ]);

        return redirect()->route('simulasi-defisit.index')
            ->with('success', 'Simulasi berhasil dihitung dan disimpan!')
            ->with('calorieDeficitPerDay', round($calorieDeficitPerDay, 2));
    }

    private function calculateCalories($targetBerat, $durasi, $tingkatAktivitas)
    {
        // Multiplier berdasarkan tingkat aktivitas
        $aktivitasMultiplier = [
            'rendah' => 1.2,  // Aktivitas rendah
            'sedang' => 1.55, // Aktivitas sedang
            'tinggi' => 1.9,  // Aktivitas tinggi
        ];

        // Ambil multiplier berdasarkan tingkat aktivitas
        $multiplier = $aktivitasMultiplier[$tingkatAktivitas] ?? 1.2;

        // Hitung kebutuhan kalori
        // Rumus: (target berat badan * 24 jam * multiplier aktivitas) / durasi
        $kebutuhanKalori = ($targetBerat * 24 * $multiplier) / $durasi;

        return round($kebutuhanKalori, 2); // Kembalikan hasil dengan 2 desimal
    }

    private function generateActivityRecommendation($tingkatAktivitas)
    {
        $recommendations = [
            'Lari 30 menit',
            'Jalan kaki 1 jam',
            'Bersepeda 45 menit',
            'Renang 30 menit',
            'Lompat tali 20 menit',
            'Aerobik 40 menit',
            'Mendaki bukit 1 jam'
        ];

        // Randomly select 2 recommendations
        $selected = array_rand(array_flip($recommendations), 2);

        return implode(' dan ', $selected);
    }
}