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
            switch ($filter) {
                case 'mingguan':
                    $start = Carbon::now()->startOfWeek();
                    $end = Carbon::now()->endOfWeek();
                    break;

                case 'bulankalender':
                    $start = Carbon::now()->startOfMonth();
                    $end = Carbon::now()->endOfMonth();
                    break;

                case '30hari':
                    $start = Carbon::now()->subDays(29)->startOfDay(); // termasuk hari ini
                    $end = Carbon::now()->endOfDay();
                    break;

                case 'harian':
                default:
                    $start = Carbon::today();
                    $end = Carbon::today()->endOfDay();
                    break;
            }

            $query->whereBetween('consumed_at', [$start, $end]);

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
            $validated = $request->validate([
                'food_name'   => 'required|string|max:255',
                'portion'     => 'required|string|max:100',
                'calories'    => 'required|numeric|min:0',
                'protein'     => 'required|numeric|min:0',
                'carbs'       => 'required|numeric|min:0',
                'fat'         => 'required|numeric|min:0',
                'consumed_at' => 'required|date',
            ]);

            FoodLog::create($validated);

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
            $validated = $request->validate([
                'food_name'   => 'required|string|max:255',
                'portion'     => 'required|string|max:100',
                'calories'    => 'required|numeric|min:0',
                'protein'     => 'required|numeric|min:0',
                'carbs'       => 'required|numeric|min:0',
                'fat'         => 'required|numeric|min:0',
                'consumed_at' => 'required|date',
            ]);

            $foodLog = FoodLog::findOrFail($id);
            $foodLog->update($validated);

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
