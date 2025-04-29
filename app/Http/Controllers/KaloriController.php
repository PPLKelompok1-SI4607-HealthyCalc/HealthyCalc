<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KaloriController extends Controller
{
    public function index()
    {
        // Check if we have existing data
        $data = Session::get('data_kalori');
        
        // If no data, show the form
        if (!$data) {
            return view('hitungKalori', ['mode' => 'form']);
        }
        
        // If we have data, show the results
        return view('hitungKalori', ['mode' => 'results', 'data' => $data]);
    }

    public function hitung(Request $request)
    {
        $request->validate([
            'usia' => 'required|numeric|min:1',
            'jenis_kelamin' => 'required|in:laki,perempuan',
            'berat_badan' => 'required|numeric|min:1',
            'tinggi_badan' => 'required|numeric|min:1',
            'tingkat_aktivitas' => 'required|in:rendah,sedang,tinggi',
            'tujuan' => 'required|in:turun,jaga,naik',
        ]);

        $usia = $request->usia;
        $jenis_kelamin = $request->jenis_kelamin;
        $berat_badan = $request->berat_badan;
        $tinggi_badan = $request->tinggi_badan;
        $tingkat_aktivitas = $request->tingkat_aktivitas;
        $tujuan = $request->tujuan;

        // Hitung BMR
        $bmr = ($jenis_kelamin === 'laki') 
            ? 88.36 + (13.4 * $berat_badan) + (4.8 * $tinggi_badan) - (5.7 * $usia)
            : 447.6 + (9.2 * $berat_badan) + (3.1 * $tinggi_badan) - (4.3 * $usia);

        // Hitung TDEE
        $faktor_aktivitas = [
            'rendah' => 1.2,
            'sedang' => 1.55,
            'tinggi' => 1.9
        ];
        $tdee = $bmr * $faktor_aktivitas[$tingkat_aktivitas];

        // Hitung total kalori berdasarkan tujuan
        $penyesuaian_tujuan = [
            'turun' => -500,
            'jaga' => 0,
            'naik' => 500
        ];
        $total_kalori = $tdee + $penyesuaian_tujuan[$tujuan];

        // Hitung distribusi nutrisi
        $protein_per_kg = 1.6; // gram protein per kg berat badan
        $protein = $berat_badan * $protein_per_kg;
        $kalori_protein = $protein * 4;
        $persen_protein = ($kalori_protein / $total_kalori) * 100;

        $persen_lemak = 25; // 25% dari total kalori
        $kalori_lemak = ($total_kalori * $persen_lemak) / 100;
        $lemak = $kalori_lemak / 9; // 1 gram lemak = 9 kalori

        $persen_karbohidrat = 100 - $persen_protein - $persen_lemak;
        $kalori_karbohidrat = ($total_kalori * $persen_karbohidrat) / 100;
        $karbohidrat = $kalori_karbohidrat / 4; // 1 gram karbohidrat = 4 kalori

        // Simpan data ke session
        $data = [
            'usia' => $usia,
            'jenis_kelamin' => $jenis_kelamin,
            'berat_badan' => $berat_badan,
            'tinggi_badan' => $tinggi_badan,
            'tingkat_aktivitas' => $tingkat_aktivitas,
            'tujuan' => $tujuan,
            'bmr' => $bmr,
            'tdee' => $tdee,
            'total_kalori' => $total_kalori,
            'protein' => $protein,
            'lemak' => $lemak,
            'karbohidrat' => $karbohidrat,
            'persen_protein' => $persen_protein,
            'persen_lemak' => $persen_lemak,
            'persen_karbohidrat' => $persen_karbohidrat,
            'faktor_aktivitas' => $faktor_aktivitas[$tingkat_aktivitas]
        ];

        Session::put('data_kalori', $data);

        return redirect()->route('kalori.index');
    }

    public function edit()
    {
        $data = Session::get('data_kalori');
        return view('hitungKalori', ['mode' => 'edit', 'data' => $data]);
    }

    public function reset()
    {
        Session::forget('data_kalori');
        return redirect()->route('kalori.index');
    }
}