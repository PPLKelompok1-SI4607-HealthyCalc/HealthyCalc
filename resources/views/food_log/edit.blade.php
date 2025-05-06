@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">Edit Makanan</h2>

    <form action="{{ route('food_log.update', $foodLog->id) }}" method="POST" class="bg-white p-8 rounded-xl shadow-md space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="food_name" class="block text-sm font-medium text-gray-700">Nama Makanan</label>
                <input type="text" id="food_name" name="food_name" value="{{ old('food_name', $foodLog->food_name) }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 @error('food_name') border-red-500 @enderror" required>
                @error('food_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="portion" class="block text-sm font-medium text-gray-700">Porsi</label>
                <input type="text" id="portion" name="portion" value="{{ old('portion', $foodLog->portion) }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 @error('portion') border-red-500 @enderror" required>
                @error('portion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="calories" class="block text-sm font-medium text-gray-700">Kalori</label>
                <input type="number" id="calories" name="calories" value="{{ old('calories', $foodLog->calories) }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 @error('calories') border-red-500 @enderror" required>
                @error('calories')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="protein" class="block text-sm font-medium text-gray-700">Protein (g)</label>
                <input type="number" id="protein" name="protein" value="{{ old('protein', $foodLog->protein) }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 @error('protein') border-red-500 @enderror" required>
                @error('protein')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="carbs" class="block text-sm font-medium text-gray-700">Karbohidrat (g)</label>
                <input type="number" id="carbs" name="carbs" value="{{ old('carbs', $foodLog->carbs) }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 @error('carbs') border-red-500 @enderror" required>
                @error('carbs')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="fat" class="block text-sm font-medium text-gray-700">Lemak (g)</label>
                <input type="number" id="fat" name="fat" value="{{ old('fat', $foodLog->fat) }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 @error('fat') border-red-500 @enderror" required>
                @error('fat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="consumed_at" class="block text-sm font-medium text-gray-700">Tanggal & Waktu Konsumsi</label>
                <input type="datetime-local" id="consumed_at" name="consumed_at"
                    value="{{ old('consumed_at', \Carbon\Carbon::parse($foodLog->consumed_at)->format('Y-m-d\TH:i')) }}"
                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 @error('consumed_at') border-red-500 @enderror" required>
                @error('consumed_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-between pt-6">
            <button type="submit"
                class="inline-flex items-center px-6 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 shadow">
                <i class="bi bi-pencil-square mr-2"></i> Simpan Perubahan
            </button>
            <a href="{{ route('food_log.index') }}"
               class="inline-flex items-center px-6 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded hover:bg-gray-300 shadow">
                <i class="bi bi-arrow-left-circle mr-2"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
