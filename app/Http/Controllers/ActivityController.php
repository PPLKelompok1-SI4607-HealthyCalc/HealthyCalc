<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index()
    {
        $data = [
            'activities' => Activity::latest()->get(),
            'totalKalori' => Activity::sum('kalori'),
            'totalJam' => round(Activity::sum('durasi') / 60, 1),
            'totalMingguIni' => Activity::whereBetween('waktu', [
                now()->startOfWeek(), 
                now()->endOfWeek()
            ])->count()
        ];
        
        return view('aktivitas.index', $data);
    }

    public function manage(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama' => 'required|max:255',
                'intensitas' => 'required|in:Ringan,Sedang,Tinggi',
                'durasi' => 'required|integer|min:1',
                'kalori' => 'required|numeric|min:0',
                'waktu' => 'required|date'
            ]);

            $data = $request->all();
            $data['user_id'] = auth()->id();

            if ($id) {
                Activity::findOrFail($id)->update($data);
                $message = 'Aktivitas berhasil diperbarui!';
            } else {
                Activity::create($data);
                $message = 'Aktivitas berhasil ditambahkan!';
            }

            return redirect('/aktivitas')->with('success', $message);
        }

        return view('aktivitas.manage', [
            'activity' => $id ? Activity::findOrFail($id) : null
        ]);
    }

    public function delete($id)
    {
        Activity::findOrFail($id)->delete();
        return back()->with('success', 'Aktivitas berhasil dihapus.');
    }
}