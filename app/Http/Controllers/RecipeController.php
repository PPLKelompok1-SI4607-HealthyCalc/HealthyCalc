<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'calories' => 'required|integer',
            'protein'=> 'required|integer',
            'carbs' => 'required|integer',
            'fat' => 'required|integer',
            'time' => 'required|string|max:20',
            'tag' => 'required|string|max:50',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        $recipe = new Recipe();
        $recipe->nama_resep = $request->name;
        $recipe->kalori = $request->calories;
        $recipe->protein = $request->protein;
        $recipe->carbs = $request->carbs;
        $recipe->fat = $request->fat;
        $recipe->waktu_masak = $request->time;
        $recipe->tag_nutrisi = $request->tag;
        $recipe->bahan = $request->ingredients ?? '';
        $recipe->langkah = $request->instructions ?? '';

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('recipes', 'public');
        }

        $recipe->save();

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil ditambahkan');
    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);

        // Convert DB field names to match the field names used in the view
        $recipeData = [
            'id' => $recipe->id,
            'name' => $recipe->nama_resep,
            'calories' => $recipe->kalori,
            'protein' => $recipe->protein,
            'carbs' => $recipe->carbs,
            'fat' => $recipe->fat,
            'time' => $recipe->waktu_masak,
            'tag' => $recipe->tag_nutrisi,
            'ingredients' => $recipe->bahan,
            'instructions' => $recipe->langkah,
            'image' => $recipe->image,
        ];

        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'calories' => 'required|integer',
            'protein' => 'required|integer',
            'carbs' => 'required|integer',
            'fat' => 'required|integer',
            'time' => 'required|string|max:20',
            'tag' => 'required|string|max:50',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recipe = Recipe::findOrFail($id);
        $recipe->update([
            'nama_resep' => $request->name,
            'kalori' => $request->calories,
            'protein' => $request->protein,
            'carbs' => $request->carbs,
            'fat' => $request->fat,
            'waktu_masak' => $request->time,
            'tag_nutrisi' => $request->tag,
            'bahan' => $request->ingredients,
            'langkah' => $request->instructions,
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            $recipe->image = $request->file('image')->store('recipes', 'public');
            $recipe->save();
        }

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);

        // Hapus gambar jika ada
        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil dihapus');
    }
}