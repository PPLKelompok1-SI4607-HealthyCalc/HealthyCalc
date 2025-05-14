<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnalyticsSetting;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    // Tampilkan form input pengaturan analitik
    public function create()
    {
        return view('analytics.create');
    }

    // Simpan data pengaturan analitik
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category' => 'required|string|max:100',
            'custom_target' => 'nullable|numeric|min:0',
        ]);

        AnalyticsSetting::create([
            'user_id' => Auth::id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'category' => $request->category,
            'custom_target' => $request->custom_target,
        ]);

        return redirect()->route('analytics.create')->with('success', 'Pengaturan analitik berhasil disimpan.');
    }
}
