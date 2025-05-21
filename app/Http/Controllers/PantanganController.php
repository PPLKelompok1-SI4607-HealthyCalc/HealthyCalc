<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pantangan;

class PantanganController extends Controller
{
    public function index()
    {
        $pantangan = Pantangan::all();

        $kategoriCounts = [
            'Alergi' => $pantangan->where('kategori', 'Alergi')->count(),
            'Kesehatan' => $pantangan->where('kategori', 'Kesehatan')->count(),
            'Diet' => $pantangan->where('kategori', 'Diet')->count(),
        ];

        return view('pantangan', compact('pantangan', 'kategoriCounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'kategori' => 'required|in:Alergi,Kesehatan,Diet'
        ]);

        Pantangan::create($request->only('nama_makanan', 'kategori'));

        return redirect()->route('pantangan.index');
    }

    public function edit($id)
    {
        $editPantangan = Pantangan::findOrFail($id);
        $pantangan = Pantangan::all();

        $kategoriCounts = [
            'Alergi' => $pantangan->where('kategori', 'Alergi')->count(),
            'Kesehatan' => $pantangan->where('kategori', 'Kesehatan')->count(),
            'Diet' => $pantangan->where('kategori', 'Diet')->count(),
        ];

        return view('pantangan', compact('pantangan', 'kategoriCounts', 'editPantangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'kategori' => 'required|in:Alergi,Kesehatan,Diet'
        ]);

        $pantangan = Pantangan::findOrFail($id);
        $pantangan->update($request->only('nama_makanan', 'kategori'));

        return redirect()->route('pantangan.index');
    }

    public function destroy($id)
    {
        $pantangan = Pantangan::findOrFail($id);
        $pantangan->delete();

        return redirect()->route('pantangan.index');
    }
}
