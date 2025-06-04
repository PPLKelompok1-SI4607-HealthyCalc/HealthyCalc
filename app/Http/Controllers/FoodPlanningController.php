<?php

namespace App\Http\Controllers;

use App\Models\FoodPlanning;
use App\Http\Requests\StoreFoodPlanningRequest;
use App\Http\Requests\UpdateFoodPlanningRequest;
use App\Models\Recipe;

class FoodPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recommendedFoods = Recipe::with('user')->limit(3)->get();
        $foodPlannings = FoodPlanning::with('user')->where('user_id', auth()->id())->latest()->paginate(6);
        return view('food-planning.index', compact('foodPlannings', 'recommendedFoods'));
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
    public function store(StoreFoodPlanningRequest $request)
    {
        $validatedData = $request->validate([
            'food_category' =>  'required|in:Sarapan,Makan Siang,Makan Malam',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'planned_time' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tangani upload file dahulu
        if ($request->file('image')) {
            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('img'), $filename);
            $validatedData['image'] = $filename; // Masukkan image ke data yang akan diupdate
        }

        $validatedData['user_id'] = auth()->user()->id;

        FoodPlanning::create($validatedData);

        return redirect()->route('food-plannings.index')->with('success', 'Rencana makanan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodPlanning $foodPlanning)
    {
        $foodPlanning = FoodPlanning::with('user')->find($foodPlanning->id);
        return view('food-planning.show', compact('foodPlanning'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodPlanning $foodPlanning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodPlanningRequest $request, FoodPlanning $foodPlanning)
    {
        $validatedData = $request->validate([
            'food_category' =>  'required|in:Sarapan,Makan Siang,Makan Malam',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'planned_time' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tangani upload file dahulu
        if ($request->file('image')) {
            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('img'), $filename);
            $validatedData['image'] = $filename; // Masukkan image ke data yang akan diupdate
        }

        // Konversi planned_time ke format H:i:s
        $validatedData['planned_time'] = \Carbon\Carbon::createFromFormat('H:i', $validatedData['planned_time'])->format('H:i:s');

        $foodPlanning->update($validatedData);
        return redirect()->route('food-plannings.show', $foodPlanning->id)->with('success', 'Rencana makanan berhasil diperbarui')->with('success', 'Rencana makanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodPlanning $foodPlanning)
    {
        $foodPlanning->delete();
        return redirect()->route('food-plannings.index')->with('success', 'Rencana makanan sudah berhasil dihapus');
    }
}
