<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    // PBI #15 - Tampilkan form tambah resep
    public function create()
    {
        return view('recipes.create');
    }

    // PBI #15 - Simpan resep baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
        ]);

        Recipe::create($request->all());

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    // PBI #22 - Tampilkan daftar resep
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', compact('recipes'));
    }
}
