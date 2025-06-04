<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
class DashboardHomeController extends Controller{
    public function index()
    {
        $dashboards = Dashboard::all();
        return view('dashboard.index', compact('dashboards'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        // tambahkan validasi lain sesuai kebutuhan
    ]);

    $dashboard = new Dashboard();
    $dashboard->name = $validated['name'];
    // tambahkan field lain sesuai kebutuhan
    $dashboard->save();

    return response()->json([
        'message' => 'Dashboard berhasil ditambahkan',
        'data' => $dashboard
    ], 201);
    
}

    public function showChart($id)
    {
        $dashboard = Dashboard::findOrFail($id);
        // Data chart bisa diambil atau diolah di sini, contoh sederhana:
        $chartData = [
            // Contoh data statis, ganti dengan data sesuai kebutuhan
            'labels' => ['Januari', 'Februari', 'Maret'],
            'values' => [10, 20, 15],
        ];
        return view('dashboard.chart', compact('dashboard', 'chartData'));
    }
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
        $data = $request->validate([
            'target_berat' => 'required|numeric',
            'durasi' => 'required|integer',
            'tingkat_aktivitas' => 'required|string',
        ]);

        $data['kebutuhan_kalori'] = $this->calculateCalories($data['target_berat'], $data['durasi'], $data['tingkat_aktivitas']);
        $data['rekomendasi_aktivitas'] = $this->generateActivityRecommendation($data['tingkat_aktivitas']);

        SimulasiDefisit::create($data);

        return redirect()->route('simulasi-defisit.index');
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

}
