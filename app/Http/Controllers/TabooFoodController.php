<?php

namespace App\Http\Controllers;

use App\Models\TabooFood;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTabooFoodRequest;
use App\Http\Requests\UpdateTabooFoodRequest;

class TabooFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tabooFoods = TabooFood::with('user')->where('user_id', auth()->id())->get();
        // Mengelompokkan dan menghitung jumlah masing-masing kategori taboo
        $tabooCounts = TabooFood::select('taboo', DB::raw('count(*) as total'))
            ->where('user_id', auth()->id())
            ->groupBy('taboo')
            ->pluck('total', 'taboo'); 

        return view('taboo_food.index', compact('tabooFoods', 'tabooCounts'));
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
    public function store(StoreTabooFoodRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();
        TabooFood::create($validatedData);
        return redirect()->route('taboo-foods.index')->with('success', 'Taboo food created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TabooFood $tabooFood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TabooFood $tabooFood)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTabooFoodRequest $request, TabooFood $tabooFood)
    {
        $validatedData = $request->validated();
        $tabooFood->update($validatedData);
        return redirect()->route('taboo-foods.index')->with('success', 'Taboo food updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TabooFood $tabooFood)
    {
        $tabooFood->delete();
        return redirect()->route('taboo-foods.index')->with('success', 'Taboo food deleted successfully.');
    }
}
