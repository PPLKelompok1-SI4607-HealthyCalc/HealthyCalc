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
