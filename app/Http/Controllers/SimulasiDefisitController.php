<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimulasiDefisit;

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
            'target_weight' => 'required|numeric|min:1',
            'current_weight' => 'required|numeric|min:1',
            'time_frame' => 'required|numeric|min:1',
        ]);

        $currentWeight = $validated['current_weight'];
        $targetWeight = $validated['target_weight'];
        $timeFrame = $validated['time_frame'];

        // Hitung defisit kalori
        $weightDifference = $currentWeight - $targetWeight;
        $calorieDeficitPerDay = ($weightDifference * 7700) / ($timeFrame * 7);

        return redirect()->route('simulasi-defisit.index')
            ->with('success', 'Simulasi berhasil dihitung!')
            ->with('calorieDeficitPerDay', round($calorieDeficitPerDay, 2));
    }

    public function edit(SimulasiDefisit $simulasiDefisit)
    {
        return view('simulasi-defisit.edit', compact('simulasiDefisit'));
    }

    public function update(Request $request, SimulasiDefisit $simulasiDefisit)
    {
        $data = $request->validate([
            'target_berat' => 'required|numeric',
            'durasi' => 'required|integer',
            'tingkat_aktivitas' => 'required|string',
        ]);

        $data['kebutuhan_kalori'] = $this->calculateCalories($data['target_berat'], $data['durasi'], $data['tingkat_aktivitas']);
        $data['rekomendasi_aktivitas'] = $this->generateActivityRecommendation($data['tingkat_aktivitas']);

        $simulasiDefisit->update($data);

        return redirect()->route('simulasi-defisit.index');
    }

    public function destroy(SimulasiDefisit $simulasiDefisit)
    {
        $simulasiDefisit->delete();
        return redirect()->route('simulasi-defisit.index');
    }

    public function hitung(Request $request)
    {
        $validated = $request->validate([
            'target_weight' => 'required|numeric|min:1',
            'current_weight' => 'required|numeric|min:1',
            'time_frame' => 'required|numeric|min:1',
        ]);

        $currentWeight = $validated['current_weight'];
        $targetWeight = $validated['target_weight'];
        $timeFrame = $validated['time_frame'];

        // Hitung defisit kalori
        $weightDifference = $currentWeight - $targetWeight;
        $calorieDeficitPerDay = ($weightDifference * 7700) / ($timeFrame * 7);

        return redirect()->route('simulasi-defisit.index')
            ->with('success', 'Simulasi berhasil dihitung!')
            ->with('calorieDeficitPerDay', round($calorieDeficitPerDay, 2));
    }

    private function calculateCalories($targetBerat, $durasi, $tingkatAktivitas)
    {
        return 2000 - ($targetBerat / $durasi) * 500; // Contoh sederhana
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