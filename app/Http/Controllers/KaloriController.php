<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kalkulasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KaloriController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;

        // Pastikan profil pengguna ada
        if (!$profile) {
            return redirect()->route('profile.edit')->with('error', 'Harap lengkapi profil Anda terlebih dahulu.');
        }

        return view('kalori.index', compact('profile'));
    }

    public function hitung(Request $request)
    {
        // Validasi input
        $request->validate([
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'height' => 'required|integer|min:50|max:250',
            'weight' => 'required|numeric|min:20|max:300',
            'activity_level' => 'required|string|in:Sangat Aktif,Cukup Aktif,Kurang Aktif',
        ]);

        // Perhitungan kalori
        $bmr = $request->gender === 'Laki-laki'
            ? 88.36 + (13.4 * $request->weight) + (4.8 * $request->height) - (5.7 * $request->age)
            : 447.6 + (9.2 * $request->weight) + (3.1 * $request->height) - (4.3 * $request->age);

        $activity_multiplier = match ($request->activity_level) {
            'Sangat Aktif' => 1.9,
            'Cukup Aktif' => 1.55,
            'Kurang Aktif' => 1.2,
        };

        $calories = $bmr * $activity_multiplier;

        // Distribusi nutrisi
        $protein_calories = $calories * 0.25; // 25% dari kalori untuk protein
        $carbs_calories = $calories * 0.50; // 50% dari kalori untuk karbohidrat
        $fat_calories = $calories * 0.25; // 25% dari kalori untuk lemak

        $protein = $protein_calories / 4; // 1 gram protein = 4 kalori
        $carbs = $carbs_calories / 4; // 1 gram karbohidrat = 4 kalori
        $fat = $fat_calories / 9; // 1 gram lemak = 9 kalori

        // Simpan hasil perhitungan ke profil pengguna
        $user = auth()->user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->back()->with('error', 'Profil pengguna tidak ditemukan.');
        }

        $profile->update([
            'calorie_limit' => $calories,
            'protein_limit' => $protein,
            'carbs_limit' => $carbs,
            'fat_limit' => $fat,
        ]);

        // Tetap di halaman hasil perhitungan
        return view('kalori.result', compact('calories', 'protein', 'carbs', 'fat'));
    }

    public function reset()
    {
        // Hapus session dan reset database
        Session::forget('data_kalori');
        Kalkulasi::truncate();  // Hapus semua data, sesuaikan jika ingin hanya hapus data tertentu
        
        return redirect()->route('kalori.index');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Pastikan profil pengguna sudah ada
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->back()->with('error', 'Profil pengguna tidak ditemukan.');
        }

        // Simpan hasil perhitungan ke profil pengguna
        $profile->update([
            'calorie_limit' => $request->calories,
            'protein_limit' => $request->protein,
            'carbs_limit' => $request->carbs,
            'fat_limit' => $request->fat,
        ]);

        return redirect()->route('food-intakes.create')->with('success', 'Hasil perhitungan kalori berhasil disimpan!');
    }

    private function mapTingkatAktivitas($aktivitas, $reverse = false)
    {
        $tingkat_aktivitas = [
            'rendah' => 'Rendah',
            'sedang' => 'Sedang',
            'tinggi' => 'Tinggi'
        ];

        if ($reverse) {
            return array_flip($tingkat_aktivitas)[$aktivitas] ?? null;
        }

        return $tingkat_aktivitas[$aktivitas] ?? null;
    }

    private function mapTujuan($tujuan, $reverse = false)
    {
        $tujuan_map = [
            'turun' => 'Turun',
            'jaga' => 'Jaga',
            'naik' => 'Naik'
        ];

        if ($reverse) {
            return array_flip($tujuan_map)[$tujuan] ?? null;
        }

        return $tujuan_map[$tujuan] ?? null;
    }

    private function hitungBMR($usia, $jenis_kelamin, $berat_badan, $tinggi_badan)
    {
        if ($jenis_kelamin == 'Laki-laki') {
            return 66.5 + (13.75 * $berat_badan) + (5.003 * $tinggi_badan) - (6.755 * $usia);
        } else {
            return 655 + (9.563 * $berat_badan) + (1.850 * $tinggi_badan) - (4.676 * $usia);
        }
    }

    private function hitungPenyesuaianTujuan($tujuan)
    {
        switch ($tujuan) {
            case 'Turun':
                return -500;
            case 'Naik':
                return 500;
            default:
                return 0;
        }
    }
}
