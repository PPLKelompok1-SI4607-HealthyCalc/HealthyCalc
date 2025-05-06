@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-4">Tambah Asupan</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif


    <form action="{{ route('food-intakes.store') }}" method="POST">
        @csrf

        <!-- Nama Makanan -->
        <div class="mb-4">
            <label for="food_name" class="block text-sm font-medium text-gray-700">Nama Makanan</label>
            <input type="text" name="food_name" id="food_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Kalori -->
        <div class="mb-4">
            <label for="calories" class="block text-sm font-medium text-gray-700">Kalori (kkal)</label>
            <input type="number" name="calories" id="calories" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Protein -->
        <div class="mb-4">
            <label for="protein" class="block text-sm font-medium text-gray-700">Protein (gram)</label>
            <input type="number" name="protein" id="protein" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Karbohidrat -->
        <div class="mb-4">
            <label for="carbs" class="block text-sm font-medium text-gray-700">Karbohidrat (gram)</label>
            <input type="number" name="carbs" id="carbs" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Lemak -->
        <div class="mb-4">
            <label for="fat" class="block text-sm font-medium text-gray-700">Lemak (gram)</label>
            <input type="number" name="fat" id="fat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Waktu Makan -->
        <div class="mb-4">
            <label for="meal_time" class="block text-sm font-medium text-gray-700">Waktu Makan</label>
            <select name="meal_time" id="meal_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="Sarapan">Sarapan</option>
                <option value="Makan Siang">Makan Siang</option>
                <option value="Makan Malam">Makan Malam</option>
                <option value="Camilan">Camilan</option>
            </select>
        </div>

        <!-- Waktu Konsumsi -->
        <div class="mb-4">
            <label for="consumed_at" class="block text-sm font-medium text-gray-700">Waktu Konsumsi</label>
            <input type="datetime-local" name="consumed_at" id="consumed_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Tambah Asupan</button>
    </form>
</div>
@endsection
