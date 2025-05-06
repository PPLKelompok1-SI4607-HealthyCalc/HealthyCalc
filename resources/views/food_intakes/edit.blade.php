@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-4">Edit Makanan</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('food-intakes.update', $intake->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nama Makanan -->
        <div class="mb-4">
            <label for="food_name" class="block text-sm font-medium text-gray-700">Nama Makanan</label>
            <input type="text" name="food_name" id="food_name" value="{{ old('food_name', $intake->food_name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Kalori -->
        <div class="mb-4">
            <label for="calories" class="block text-sm font-medium text-gray-700">Kalori (kkal)</label>
            <input type="number" name="calories" id="calories" value="{{ old('calories', $intake->calories) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Protein -->
        <div class="mb-4">
            <label for="protein" class="block text-sm font-medium text-gray-700">Protein (gram)</label>
            <input type="number" name="protein" id="protein" value="{{ old('protein', $intake->protein) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Karbohidrat -->
        <div class="mb-4">
            <label for="carbs" class="block text-sm font-medium text-gray-700">Karbohidrat (gram)</label>
            <input type="number" name="carbs" id="carbs" value="{{ old('carbs', $intake->carbs) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Lemak -->
        <div class="mb-4">
            <label for="fat" class="block text-sm font-medium text-gray-700">Lemak (gram)</label>
            <input type="number" name="fat" id="fat" value="{{ old('fat', $intake->fat) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Waktu Makan -->
        <div class="mb-4">
            <label for="meal_time" class="block text-sm font-medium text-gray-700">Waktu Makan</label>
            <select name="meal_time" id="meal_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="Sarapan" {{ old('meal_time', $intake->meal_time) == 'Sarapan' ? 'selected' : '' }}>Sarapan</option>
                <option value="Makan Siang" {{ old('meal_time', $intake->meal_time) == 'Makan Siang' ? 'selected' : '' }}>Makan Siang</option>
                <option value="Makan Malam" {{ old('meal_time', $intake->meal_time) == 'Makan Malam' ? 'selected' : '' }}>Makan Malam</option>
                <option value="Camilan" {{ old('meal_time', $intake->meal_time) == 'Camilan' ? 'selected' : '' }}>Camilan</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan Perubahan</button>
    </form>
</div>
@endsection
