<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;

        return view('dashboard', compact('user', 'profile'));
    }
}