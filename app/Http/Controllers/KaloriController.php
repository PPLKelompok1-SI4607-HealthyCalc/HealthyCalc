<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kalkulasi;
use Illuminate\Support\Facades\Auth;

class KaloriController extends Controller
{
    public function index()
    {
        // Cek apakah ada data di database
        $kalkulasi = Kalkulasi::latest()->first();
        
        // Jika tidak ada data di database, periksa session
        if (!$kalkulasi) {
            $data = Session::get('data_kalori');
            
            // Jika tidak ada data sama sekali, tampilkan form
            if (!$data) {
                return view('hitungKalori', ['mode' => 'form']);
            }
            
            // Jika hanya ada di session, tampilkan hasil dari session
            return view('hitungKalori', ['mode' => 'results', 'data' => $data]);
        }
        
        // Jika ada data di database, tampilkan dari database
        $data = [
            'usia' => $kalkulasi->usia,
            'jenis_kelamin' => $kalkulasi->jenis_kelamin == 'Laki-laki' ? 'laki' : 'perempuan',
            'berat_badan' => $kalkulasi->berat_badan,
            'tinggi_badan' => $kalkulasi->tinggi_badan,
            'tingkat_aktivitas' => $this->mapTingkatAktivitas($kalkulasi->tingkat_aktivitas, true),
            'tujuan' => $this->mapTujuan($kalkulasi->tujuan, true),
            'faktor_aktivitas' => $kalkulasi->faktor_aktivitas,
            'total_kalori' => $kalkulasi->kalori_harian,
            // Hitung kembali distribusi nutrisi untuk ditampilkan
            'bmr' => $this->hitungBMR($kalkulasi->usia, $kalkulasi->jenis_kelamin, $kalkulasi->berat_badan, $kalkulasi->tinggi_badan),
            'tdee' => $kalkulasi->kalori_harian - $this->hitungPenyesuaianTujuan($kalkulasi->tujuan),
        ];
        
        // Hitung distribusi nutrisi
        $protein_per_kg = 1.6;
        $protein = $kalkulasi->berat_badan * $protein_per_kg;
        $kalori_protein = $protein * 4;
        $persen_protein = ($kalori_protein / $kalkulasi->kalori_harian) * 100;

        $persen_lemak = 25;
        $kalori_lemak = ($kalkulasi->kalori_harian * $persen_lemak) / 100;
        $lemak = $kalori_lemak / 9;

        $persen_karbohidrat = 100 - $persen_protein - $persen_lemak;
        $kalori_karbohidrat = ($kalkulasi->kalori_harian * $persen_karbohidrat) / 100;
        $karbohidrat = $kalori_karbohidrat / 4;
        
        $data['protein'] = $protein;
        $data['lemak'] = $lemak;
        $data['karbohidrat'] = $karbohidrat;
        $data['persen_protein'] = $persen_protein;
        $data['persen_lemak'] = $persen_lemak;
        $data['persen_karbohidrat'] = $persen_karbohidrat;
        
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

        // Map nilai form ke format database
        $jenis_kelamin_db = ($jenis_kelamin === 'laki') ? 'Laki-laki' : 'Perempuan';
        $tingkat_aktivitas_db = $this->mapTingkatAktivitas($tingkat_aktivitas);
        $tujuan_db = $this->mapTujuan($tujuan);

        // Hitung BMR
        $bmr = $this->hitungBMR($usia, $jenis_kelamin_db, $berat_badan, $tinggi_badan);

        // Hitung TDEE
        $faktor_aktivitas = [
            'rendah' => 1.2,
            'sedang' => 1.55,
            'tinggi' => 1.9
        ];
        $tdee = $bmr * $faktor_aktivitas[$tingkat_aktivitas];

        // Hitung total kalori berdasarkan tujuan
        $penyesuaian_tujuan = $this->hitungPenyesuaianTujuan($tujuan_db);
        $total_kalori = $tdee + $penyesuaian_tujuan;

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

        // Simpan atau update data ke database
        $kalkulasi = Kalkulasi::latest()->first();
        
        if (!$kalkulasi) {
            // Buat data baru jika belum ada
            $kalkulasi = new Kalkulasi();
        }
        
        // Simpan data ke model
        $kalkulasi->usia = $usia;
        $kalkulasi->jenis_kelamin = $jenis_kelamin_db;
        $kalkulasi->berat_badan = $berat_badan;
        $kalkulasi->tinggi_badan = $tinggi_badan;
        $kalkulasi->tingkat_aktivitas = $tingkat_aktivitas_db;
        $kalkulasi->faktor_aktivitas = $faktor_aktivitas[$tingkat_aktivitas];
        $kalkulasi->tujuan = $tujuan_db;
        $kalkulasi->kalori_harian = $total_kalori;
        
        // Simpan ke database
        $kalkulasi->save();

        return redirect()->route('kalori.index')->with('success', 'Data berhasil disimpan ke database!');
    }

    public function edit()
    {
        // Ambil data dari database dulu
        $kalkulasi = Kalkulasi::latest()->first();
        
        // Jika ada data di database, gunakan itu
        if ($kalkulasi) {
            $data = [
                'usia' => $kalkulasi->usia,
                'jenis_kelamin' => $kalkulasi->jenis_kelamin == 'Laki-laki' ? 'laki' : 'perempuan',
                'berat_badan' => $kalkulasi->berat_badan,
                'tinggi_badan' => $kalkulasi->tinggi_badan,
                'tingkat_aktivitas' => $this->mapTingkatAktivitas($kalkulasi->tingkat_aktivitas, true),
                'tujuan' => $this->mapTujuan($kalkulasi->tujuan, true),
                'faktor_aktivitas' => $kalkulasi->faktor_aktivitas
            ];
        } else {
            // Jika tidak ada di database, coba ambil dari session
            $data = Session::get('data_kalori');
            
            // Jika tidak ada data sama sekali, redirect ke form awal
            if (!$data) {
                return redirect()->route('kalori.index');
            }
        }
        
        return view('hitungKalori', ['mode' => 'edit', 'data' => $data]);
    }

    public function reset()
    {
        // Hapus data dari session
        Session::forget('data_kalori');
        
        // Hapus data terakhir dari database (hapus semua untuk reset total)
        Kalkulasi::truncate();
        
        return redirect()->route('kalori.index')->with('success', 'Data berhasil direset!');
    }
    
    // Helper functions
    private function hitungBMR($usia, $jenis_kelamin, $berat_badan, $tinggi_badan)
    {
        return ($jenis_kelamin === 'Laki-laki') 
            ? 88.36 + (13.4 * $berat_badan) + (4.8 * $tinggi_badan) - (5.7 * $usia)
            : 447.6 + (9.2 * $berat_badan) + (3.1 * $tinggi_badan) - (4.3 * $usia);
    }
    
    private function hitungPenyesuaianTujuan($tujuan)
    {
        $penyesuaian = [
            'Menurunkan berat badan' => -500,
            'Mempertahankan berat badan' => 0,
            'Menambah berat badan' => 500
        ];
        
        return $penyesuaian[$tujuan] ?? 0;
    }
    
    private function mapTingkatAktivitas($nilai, $reverse = false)
    {
        $map = [
            'rendah' => 'Rendah',
            'sedang' => 'Sedang',
            'tinggi' => 'Tinggi'
        ];
        
        if ($reverse) {
            $map = array_flip($map);
        }
        
        return $map[$nilai] ?? $nilai;
    }
    
    private function mapTujuan($nilai, $reverse = false)
    {
        $map = [
            'turun' => 'Menurunkan berat badan',
            'jaga' => 'Mempertahankan berat badan',
            'naik' => 'Menambah berat badan'
        ];
        
        if ($reverse) {
            $map = array_flip($map);
        }
        
        return $map[$nilai] ?? $nilai;
    }
}