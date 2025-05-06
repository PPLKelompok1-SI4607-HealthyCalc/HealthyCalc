<?php

namespace App\Http\Controllers;

use App\Models\FoodLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class FoodLogController extends Controller
{
    /**
     * Tampilkan semua log makanan dengan filter waktu
     */
    public function index(Request $request)
    {
        try {
            $filter = $request->query('filter', 'harian'); // Default: harian
            $query = FoodLog::query();

            // Tentukan rentang tanggal berdasarkan filter
            $dateRanges = [
                'mingguan' => [
                    'start' => Carbon::now()->startOfWeek(),
                    'end' => Carbon::now()->endOfWeek()
                ],
                'bulankalender' => [
                    'start' => Carbon::now()->startOfMonth(),
                    'end' => Carbon::now()->endOfMonth()
                ],
                '30hari' => [
                    'start' => Carbon::now()->subDays(29)->startOfDay(),
                    'end' => Carbon::now()->endOfDay()
                ],
                'harian' => [
                    'start' => Carbon::today(),
                    'end' => Carbon::today()->endOfDay()
                ],
            ];

            // Pilih rentang waktu berdasarkan filter yang dipilih
            $range = $dateRanges[$filter] ?? $dateRanges['harian'];

            $query->whereBetween('consumed_at', [$range['start'], $range['end']]);

            $foodLogs = $query->orderByDesc('consumed_at')->paginate(10);

            // Hitung total asupan
            $intake = (object)[
                'calories' => $foodLogs->sum('calories'),
                'protein'  => $foodLogs->sum('protein'),
                'carbs'    => $foodLogs->sum('carbs'),
                'fat'      => $foodLogs->sum('fat'),
            ];

            // Target default (bisa kamu ubah jika pakai user profile)
            $target = (object)[
                'calories' => 2000,
                'protein'  => 80,
                'carbs'    => 300,
                'fat'      => 55,
            ];

            return view('food_log.index', compact('intake', 'target', 'foodLogs', 'filter'));
        } catch (\Exception $e) {
            Log::error('Gagal menampilkan riwayat makanan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data makanan.');
        }
    }

    /**
     * Tampilkan form tambah makanan
     */
    public function create()
    {
        return view('food_log.create');
    }

    /**
     * Simpan makanan baru
     */
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'food_name'   => 'required|string|max:255',
                'portion'     => 'required|string|max:100',
                'calories'    => 'required|numeric|min:0',
                'protein'     => 'required|numeric|min:0',
                'carbs'       => 'required|numeric|min:0',
                'fat'         => 'required|numeric|min:0',
                'consumed_at' => 'required|date_format:Y-m-d\TH:i',
            ]);

            // Memastikan waktu dikonversi ke zona waktu yang benar
            $consumedAt = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('consumed_at'))
                                ->timezone('Asia/Jakarta'); // Mengonversi ke zona waktu Jakarta

            // Menyimpan log makanan
            FoodLog::create([
                'food_name'   => $validated['food_name'],
                'portion'     => $validated['portion'],
                'calories'    => $validated['calories'],
                'protein'     => $validated['protein'],
                'carbs'       => $validated['carbs'],
                'fat'         => $validated['fat'],
                'consumed_at' => $consumedAt, // Waktu yang sudah dikonversi
            ]);

            return redirect()->route('food_log.index')->with('success', 'Makanan berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan makanan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan makanan.')->withInput();
        }
    }

    /**
     * Tampilkan form edit makanan
     */
    public function edit($id)
    {
        try {
            $foodLog = FoodLog::findOrFail($id);
            return view('food_log.edit', compact('foodLog'));
        } catch (\Exception $e) {
            Log::error('Gagal memuat data untuk edit: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    /**
     * Update makanan
     */
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'food_name'   => 'required|string|max:255',
                'portion'     => 'required|string|max:100',
                'calories'    => 'required|numeric|min:0',
                'protein'     => 'required|numeric|min:0',
                'carbs'       => 'required|numeric|min:0',
                'fat'         => 'required|numeric|min:0',
                'consumed_at' => 'required|date_format:Y-m-d\TH:i',
            ]);

            // Memastikan waktu dikonversi ke zona waktu yang benar
            $consumedAt = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('consumed_at'))
                                ->timezone('Asia/Jakarta'); // Mengonversi ke zona waktu Jakarta

            $foodLog = FoodLog::findOrFail($id);
            $foodLog->update([
                'food_name'   => $validated['food_name'],
                'portion'     => $validated['portion'],
                'calories'    => $validated['calories'],
                'protein'     => $validated['protein'],
                'carbs'       => $validated['carbs'],
                'fat'         => $validated['fat'],
                'consumed_at' => $consumedAt, // Waktu yang sudah dikonversi
            ]);

            return redirect()->route('food_log.index')->with('success', 'Data makanan berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui makanan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui makanan.')->withInput();
        }
    }

    /**
     * Hapus makanan
     */
    public function destroy($id)
    {
        try {
            $foodLog = FoodLog::findOrFail($id);
            $foodLog->delete();

            return redirect()->route('food_log.index')->with('success', 'Makanan berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal menghapus makanan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus makanan.');
        }
    }
}
