<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        // Filter by nutrition tag
        if ($request->has('tag_nutrisi') && $request->tag_nutrisi !== null) {
            $query->where('tag_nutrisi', $request->tag_nutrisi);
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_resep', 'like', '%'.$searchTerm.'%')
                ->orWhere('tag_nutrisi', 'like', '%'.$searchTerm.'%')
                ->orWhere('bahan', 'like', '%'.$searchTerm.'%')
                ->orWhere('langkah', 'like', '%'.$searchTerm.'%');
            });
        }

        $recipes = $query->get();

        return view('recipes.index', ['recipes' => $recipes, 'search' => $request->search,
        'tag_nutrisi' => $request->tag_nutrisi]);
    }


    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_resep' => 'required|string|max:255',
            'kalori' => 'required|numeric',
            'waktu_masak' => 'required|integer',
            'tag_nutrisi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Simpan file gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes', 'public');
        }

        // Simpan data ke database
        Recipe::create([
            'nama_resep' => $validated['nama_resep'],
            'kalori' => $validated['kalori'],
            'waktu_masak' => $validated['waktu_masak'],
            'tag_nutrisi' => $validated['tag_nutrisi'],
            'image_path' => $imagePath, // Pastikan kolom ini sesuai dengan database
        ]);

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        
        // Convert DB field names to match the field names used in the view
        $recipeData = [
            'id' => $recipe->id,
            'name' => $recipe->nama_resep,
            'calories' => $recipe->kalori,
            'time' => $recipe->waktu_masak,
            'tag' => $recipe->tag_nutrisi,
            'ingredients' => $recipe->bahan,
            'instructions' => $recipe->langkah,
            'image' => $recipe->image
        ];

        return view('recipes.create', ['recipe' => $recipeData]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'calories' => 'required|integer',
            'time' => 'required|string|max:20',
            'tag' => 'required|string|max:50',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $recipe = Recipe::findOrFail($id);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($recipe->image && Storage::disk('public')->exists($recipe->image)) {
                Storage::disk('public')->delete($recipe->image);
            }
        
            // Store new image
            $path = $request->file('image')->store('recipes', 'public');
            $recipe->image = $path;
        }

        $recipe->nama_resep = $request->name;
        $recipe->kalori = $request->calories;
        $recipe->waktu_masak = $request->time;
        $recipe->tag_nutrisi = $request->tag;
        $recipe->bahan = $request->ingredients ?? $recipe->bahan;
        $recipe->langkah = $request->instructions ?? $recipe->langkah;
        $recipe->save();

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil diperbarui');
    }

    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        
        return redirect()->route('recipes.index')->with('success', 'Resep berhasil dihapus');
    }
}