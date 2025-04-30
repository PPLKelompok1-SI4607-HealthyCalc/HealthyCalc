@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <h1 class="text-2xl font-bold text-center mb-6">HealthyCalc</h1>
    
    <!-- Nutrition Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <!-- Kalori Card -->
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="text-gray-500 text-sm">Total Kalori</h3>
            <p class="text-2xl font-bold">{{ number_format($totalCalories) }}</p>
            <p class="text-gray-400 text-sm">dari {{ number_format($targetCalories) }} kal</p>
        </div>
        
        <!-- Protein Card -->
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="text-gray-500 text-sm">Protein</h3>
            <p class="text-2xl font-bold">{{ $totalProtein }}g</p>
            <p class="text-gray-400 text-sm">dari {{ $targetProtein }}g</p>
        </div>
        
        <!-- Karbohidrat Card -->
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="text-gray-500 text-sm">Karbohidrat</h3>
            <p class="text-2xl font-bold">{{ $totalCarbs }}g</p>
            <p class="text-gray-400 text-sm">dari {{ $targetCarbs }}g</p>
        </div>
        
        <!-- Lemak Card -->
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="text-gray-500 text-sm">Lemak</h3>
            <p class="text-2xl font-bold">{{ $totalFat }}g</p>
            <p class="text-gray-400 text-sm">dari {{ $targetFat }}g</p>
        </div>
    </div>

    <!-- Add Food Buttons -->
    <div class="mb-8">
        <h2 class="text-lg font-semibold mb-3">Tambah Makanan</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('food-intakes.create') }}?meal_time=Sarapan" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
               Sarapan
            </a>
            <a href="{{ route('food-intakes.create') }}?meal_time=Makan Siang" 
               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
               Makan Siang
            </a>
            <a href="{{ route('food-intakes.create') }}?meal_time=Makan Malam" 
               class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg">
               Makan Malam
            </a>
            <a href="{{ route('food-intakes.create') }}" 
               class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
               Tambah Makanan
            </a>
            <a href="{{ route('food-intakes.create') }}?meal_time=Camilan" 
               class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
               Camilan
            </a>
        </div>
    </div>

    <!-- Food History -->
    <div>
        <h2 class="text-lg font-semibold mb-3">Riwayat Asupan Hari ini</h2>
        
        <div class="space-y-4">
            @foreach($intakes as $item)
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold">{{ $item['food_name'] }}</h3>
                        <p class="text-gray-500 text-sm">
                            {{ $item['consumed_at'] }} - {{ $item['meal_time'] }}
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                            {{ $item['calories'] }} kal
                        </span>
                        <a href="{{ route('food-intakes.edit', $item['id']) }}" 
                           class="text-yellow-500 hover:text-yellow-700">
                           <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('food-intakes.destroy', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection