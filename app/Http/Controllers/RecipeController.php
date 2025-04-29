<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    private $recipes = [];

    public function __construct()
    {
        $this->recipes = session()->get('recipes', [
            [
                'id' => 1, 
                'name' => 'Quinoa Bowl dengan Alpukat', 
                'calories' => 320, 
                'time' => '25 min', 
                'tag' => 'Rendah Kalori',
                'ingredients' => 'Quinoa, Alpukat, Tomat Cherry, Daun Bayam, Jagung Manis, Minyak Zaitun',
                'instructions' => '1. Masak quinoa sesuai petunjuk kemasan. 2. Potong alpukat dan tomat cherry. 3. Campurkan semua bahan dan sajikan.'
            ],
            [
                'id' => 2, 
                'name' => 'Ayam Panggang dengan Sayuran', 
                'calories' => 450, 
                'time' => '35 min', 
                'tag' => 'Tinggi Protein',
                'ingredients' => 'Dada Ayam, Brokoli, Wortel, Paprika, Minyak Zaitun, Bawang Putih, Garam, Lada',
                'instructions' => '1. Marinasi ayam dengan bawang putih, garam, dan lada. 2. Panggang ayam hingga matang. 3. Tumis sayuran hingga layu namun tetap renyah.'
            ],
            [
                'id' => 3, 
                'name' => 'Buddha Bowl dengan Tahu', 
                'calories' => 380, 
                'time' => '20 min', 
                'tag' => 'Vegetarian',
                'ingredients' => 'Tahu, Quinoa, Bawang Merah, Tomat, Selada, Timun, Alpukat, Saus Tahini',
                'instructions' => '1. Potong tahu menjadi dadu dan panggang hingga kecokelatan. 2. Masak quinoa. 3. Sajikan semua bahan dalam mangkuk dan siram dengan saus tahini.'
            ]
        ]);
    }

    public function index()
    {
        session()->put('recipes', $this->recipes);
        return view('recipes.index', ['recipes' => $this->recipes]);
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $recipes = session()->get('recipes', []);
        $id = count($recipes) > 0 ? max(array_column($recipes, 'id')) + 1 : 1;

        $recipes[] = [
            'id' => $id,
            'name' => $request->name,
            'calories' => $request->calories,
            'time' => $request->time,
            'tag' => $request->tag,
            'ingredients' => $request->ingredients ?? '',
            'instructions' => $request->instructions ?? ''
        ];

        session()->put('recipes', $recipes);
        return redirect()->route('recipes.index')->with('success', 'Resep berhasil ditambahkan');
    }

    public function edit($id)
    {
        $recipes = session()->get('recipes', []);
        $recipe = collect($recipes)->firstWhere('id', (int)$id);

        if (!$recipe) {
            return redirect()->route('recipes.index')->withErrors('Resep tidak ditemukan.');
        }

        return view('recipes.create', compact('recipe'));
    }

    public function update(Request $request, $id)
    {
        $recipes = session()->get('recipes', []);
        
        foreach ($recipes as &$r) {
            if ($r['id'] == $id) {
                $r['name'] = $request->name;
                $r['calories'] = $request->calories;
                $r['time'] = $request->time;
                $r['tag'] = $request->tag;
                $r['ingredients'] = $request->ingredients ?? $r['ingredients'] ?? '';
                $r['instructions'] = $request->instructions ?? $r['instructions'] ?? '';
                break;
            }
        }

        session()->put('recipes', $recipes);
        return redirect()->route('recipes.index')->with('success', 'Resep berhasil diperbarui');
    }

    public function destroy($id)
    {
        $recipes = session()->get('recipes', []);
        $recipes = array_filter($recipes, fn($r) => $r['id'] != $id);
        session()->put('recipes', array_values($recipes)); // reset index array
        return redirect()->route('recipes.index')->with('success', 'Resep berhasil dihapus');
    }
}