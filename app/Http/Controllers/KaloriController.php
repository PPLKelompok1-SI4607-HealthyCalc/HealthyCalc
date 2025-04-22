<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaloriController extends Controller
{
    public function formulir()
    {
        return view('hitungKalori.formulir');
    }

    public function hitung(Request $request)
    {
        $usia = $request->input('usia');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $berat_badan = $request->input('berat_badan');
        $tinggi_badan = $request->input('tinggi_badan');
        $tingkat_aktivitas = $request->input('tingkat_aktivitas');
        $tujuan = $request->input('tujuan');

        // Hitung BMR
        if ($jenis_kelamin === 'Laki-laki') {
            $bmr = 10 * $berat_badan + 6.25 * $tinggi_badan - 5 * $usia + 5;
        } else {
            $bmr = 10 * $berat_badan + 6.25 * $tinggi_badan - 5 * $usia - 161;
        }

        // Hitung TDEE
        $faktor_aktivitas = match ($tingkat_aktivitas) {
            'rendah' => 1.2,
            'sedang' => 1.55,
            'tinggi' => 1.9,
            default => 1.2,
        };

        $tdee = $bmr * $faktor_aktivitas;

        // Total kalori harian berdasarkan tujuan
        $total_kalori = match ($tujuan) {
            'menambah berat badan' => $tdee + 500,
            'menurunkan berat badan' => $tdee - 500,
            default => $tdee,
        };

        return view('hitungKalori.hasil', compact(
            'bmr', 'tdee', 'total_kalori',
            'usia', 'jenis_kelamin', 'berat_badan',
            'tinggi_badan', 'tingkat_aktivitas', 'tujuan'
        ));
    }
}

