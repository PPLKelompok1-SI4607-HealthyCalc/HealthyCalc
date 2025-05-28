<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSimulationRequest;
use App\Http\Requests\UpdateSimulationRequest;

class SimulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile; 
        $simulation = $user->simulations()->latest()->get();

        return view('simulation.index', compact('profile', 'simulation'));
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
    public function store(StoreSimulationRequest $request)
    {
        $request->validate([
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'target_weight' => 'required|numeric',
            'calories' => 'required|numeric',
            'target_calories' => 'required|numeric',
        ]);
    
        $user = Auth::user();
        $profile = $user->profile;
    
        $current_weight = $request->weight ?? $profile->weight;
        $target_weight = $request->target_weight;
        $calories = $request->calories;
        $target_calories = $request->target_calories;
        $activity_level = $request->activity_level ??$profile->activity_level;
    
        // Hitungan default (0.5 kg per minggu)
        $weekly_change = 0.5;
        $total_change = abs($current_weight - $target_weight);
        $estimated_time = $weekly_change > 0 ? ceil($total_change / $weekly_change) : 0;
    
        // Target harian kalori
        $target_daily_calories = $target_calories;
    
        // Rekomendasi
        $recommendation = '';
        if ($target_calories < $calories) {
            $recommendation = 'Kurangi porsi karbohidrat dan tingkatkan protein untuk mempertahankan massa otot selama defisit kalori';
        } elseif ($target_calories > $calories) {
            $recommendation = 'Tingkatkan asupan kalori sehat seperti lemak baik dan karbohidrat kompleks untuk surplus kalori';
        } else {
            $recommendation = 'Pertahankan pola makan dan aktivitas untuk menjaga berat badan saat ini';
        }
    
        // Simpan ke DB
        Simulation::create([
            'user_id' => $user->id,
            'weight' => $current_weight,
            'target_weight' => $target_weight,
            'calories' => $calories,
            'target_calories' => $target_calories,
            'activity_level' => $activity_level,
            'estimated_time' => $estimated_time,
            'weekly_change' => $weekly_change,
            'target_daily_calories' => $target_daily_calories,
            'recommendation' => $recommendation,
        ]);
    
        return redirect()->route('simulations.index')->with('success', 'Simulasi berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Simulation $simulation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Simulation $simulation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSimulationRequest $request, Simulation $simulation)
    {
        $user = Auth::user();

    // Validasi ownership (opsional tapi sangat dianjurkan)
    if ($simulation->user_id !== $user->id) {
        abort(403, 'Akses tidak diizinkan.');
    }

    // Ambil data dari profile (yang tidak bisa diubah di modal edit)
    $profile = $user->profile;
    $current_weight = $profile->weight;
    $activity_level = $profile->activity_level;

    // Ambil data baru dari input
    $target_weight = $request->target_weight;
    $calories = $request->calories;
    $target_calories = $request->target_calories;

    // Hitung ulang estimasi waktu dan target
    $weekly_change = 0.5; // default perubahan mingguan
    $total_change = abs($current_weight - $target_weight);
    $estimated_time = $weekly_change > 0 ? ceil($total_change / $weekly_change) : 0;

    // Rekomendasi dinamis
    if ($target_calories < $calories) {
        $recommendation = 'Kurangi porsi karbohidrat dan tingkatkan protein untuk mempertahankan massa otot selama defisit kalori';
    } elseif ($target_calories > $calories) {
        $recommendation = 'Tingkatkan asupan kalori sehat seperti lemak baik dan karbohidrat kompleks untuk surplus kalori';
    } else {
        $recommendation = 'Pertahankan pola makan dan aktivitas untuk menjaga berat badan saat ini';
    }

    // Update data simulasi
    $simulation->update([
        'weight' => $current_weight,
        // 'target_weight' => $target_weight,
        'calories' => $calories,
        'target_calories' => $target_calories,
        'activity_level' => $activity_level,
        'estimated_time' => $estimated_time,
        'weekly_change' => $weekly_change,
        'target_daily_calories' => $target_calories,
        'recommendation' => $recommendation,
    ]);

    return redirect()->route('simulations.index')->with('success', 'Simulasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Simulation $simulation)
    {
        $user = Auth::user();

        // Cek apakah simulasi milik user yang sedang login
        if ($simulation->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
    
        $simulation->delete();
    
        return redirect()->route('simulations.index')->with('success', 'Simulasi berhasil dihapus.');
    }
}
