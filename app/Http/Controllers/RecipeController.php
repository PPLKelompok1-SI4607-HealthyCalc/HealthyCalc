<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::with('user')->where('user_id', auth()->id())->latest()->paginate(6);
        return view('recipe.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecipeRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        if ($request->file('image')) { 
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension(); 
            $request->file('image')->move(public_path('img'), $filename); 
            $validated['image'] = $filename; 
        }
        Recipe::create($validated);

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe = Recipe::with('user')->find($recipe->id);
        return view('recipe.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $validated = $request->validated();
        if ($request->file('image')) {
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('img'), $filename);
            $validated['image'] = $filename;
        } else {
            $validated['image'] = $recipe->image;
        }
        $recipe->update($validated);

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Resep berhasil dihapus');
    }
}
