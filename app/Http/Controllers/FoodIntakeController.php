<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodIntakeController extends Controller
{
    public function index()
    {

        if (!session()->has('food_intakes')) {
            $dummyData = [
                [
                    'id' => 'dummy1',
                    'food_name' => 'Nasi Ayam Geprek',
                    'calories' => 450,
                    'protein' => 10,
                    'carbs' => 60,
                    'fat' => 15,
                    'consumed_on' => date('Y-m-d'),
                    'consumed_at' => '07:30',
                    'meal_time' => 'Sarapan',
                    'created_at' => now()
                ],
                [
                    'id' => 'dummy2',
                    'food_name' => 'Ayam Bakar Padang',
                    'calories' => 650,
                    'protein' => 30,
                    'carbs' => 5,
                    'fat' => 20,
                    'consumed_on' => date('Y-m-d'),
                    'consumed_at' => '12:30',
                    'meal_time' => 'Makan Siang',
                    'created_at' => now()
                ]
            ];
            session(['food_intakes' => $dummyData]);
        }

        $intakes = session('food_intakes', []);
    
        $totalCalories = array_sum(array_column($intakes, 'calories'));
        $totalProtein = array_sum(array_column($intakes, 'protein'));
        $totalCarbs = array_sum(array_column($intakes, 'carbs'));
        $totalFat = array_sum(array_column($intakes, 'fat'));

        $targetCalories = 2000;
        $targetProtein = 60;
        $targetCarbs = 300;
        $targetFat = 85;

        $groupedIntakes = [];
        foreach ($intakes as $intake) {
            $mealTime = $intake['meal_time'];
            if (!isset($groupedIntakes[$mealTime])) {
                $groupedIntakes[$mealTime] = [];
            }
            $groupedIntakes[$mealTime][] = $intake;
        }

        return view('food_intakes.index', compact(
            'intakes',
            'totalCalories',
            'totalProtein',
            'totalCarbs',
            'totalFat',
            'targetCalories',
            'targetProtein',
            'targetCarbs',
            'targetFat',
            'groupedIntakes'
        ));
    }

    public function create()
    {
        $mealTimes = [
            'Sarapan' => 'Sarapan',
            'Makan Siang' => 'Makan Siang',
            'Makan Malam' => 'Makan Malam',
            'Camilan' => 'Camilan'
        ];
        
        return view('food_intakes.create', compact('mealTimes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'calories' => 'required|integer|min:0',
            'protein' => 'required|integer|min:0',
            'carbs' => 'required|integer|min:0',
            'fat' => 'required|integer|min:0',
            'consumed_at' => 'required|date_format:H:i',
            'meal_time' => 'required|string'
        ]);

        $foodIntake = [
            'id' => uniqid(),
            'food_name' => $validated['food_name'],
            'calories' => $validated['calories'],
            'protein' => $validated['protein'],
            'carbs' => $validated['carbs'],
            'fat' => $validated['fat'],
            'consumed_on' => date('Y-m-d'),
            'consumed_at' => $validated['consumed_at'],
            'meal_time' => $validated['meal_time'],
            'created_at' => now()
        ];

        $intakes = session('food_intakes', []);
        $intakes[] = $foodIntake;
        session(['food_intakes' => $intakes]);

        return redirect()->route('food-intakes.index')
            ->with('success', 'Makanan berhasil ditambahkan^^');
    }

    public function edit($id)
    {
        $intakes = session('food_intakes', []);
        $intake = collect($intakes)->firstWhere('id', $id);

        if (!$intake) {
            return redirect()->route('food-intakes.index')
                ->with('error', 'Data makanan tidak ditemukan.');
        }

        $mealTimes = [
            'Sarapan' => 'Sarapan',
            'Makan Siang' => 'Makan Siang',
            'Makan Malam' => 'Makan Malam',
            'Camilan' => 'Camilan'
        ];

        return view('food_intakes.edit', compact('intake', 'mealTimes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'calories' => 'required|integer|min:0',
            'protein' => 'required|integer|min:0',
            'carbs' => 'required|integer|min:0',
            'fat' => 'required|integer|min:0',
            'consumed_at' => 'required|date_format:H:i',
            'meal_time' => 'required|string'
        ]);

        $intakes = session('food_intakes', []);
        $updated = false;

        foreach ($intakes as &$intake) {
            if ($intake['id'] == $id) {
                $intake['food_name'] = $validated['food_name'];
                $intake['calories'] = $validated['calories'];
                $intake['protein'] = $validated['protein'];
                $intake['carbs'] = $validated['carbs'];
                $intake['fat'] = $validated['fat'];
                $intake['consumed_at'] = $validated['consumed_at'];
                $intake['meal_time'] = $validated['meal_time'];
                $updated = true;
                break;
            }
        }

        if ($updated) {
            session(['food_intakes' => $intakes]);
            return redirect()->route('food-intakes.index')
                ->with('success', 'Data makanan berhasil diperbarui!');
        }

        return back()->with('error', 'Gagal memperbarui data makanan.');
    }

    public function destroy($id)
    {
        $intakes = session('food_intakes', []);
        $originalCount = count($intakes);
        
        $intakes = array_filter($intakes, function($intake) use ($id) {
            return $intake['id'] != $id;
        });

        if (count($intakes) < $originalCount) {
            session(['food_intakes' => array_values($intakes)]);
            return back()->with('success', 'Data makanan berhasil dihapus!');
        }

        return back()->with('error', 'Data makanan tidak ditemukan.');
    }
}