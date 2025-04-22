<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show()
    {
        // Pastikan view ini sesuai lokasi file kamu
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi sederhana
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        

        // Simpan data user ke database, contoh:
        // User::create([...]);

        return redirect()->back()->with('success', 'Berhasil mendaftar!');
    }
}
