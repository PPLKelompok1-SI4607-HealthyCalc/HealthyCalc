@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-4">Edit Resep</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Pastikan menggunakan PUT -->

        <!-- Nama Resep -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Resep</label>
            <input type="text" name="name" id="name" value="{{ old('name', $recipe->nama_resep) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Kalori -->
        <div class="mb-4">
            <label for="calories" class="block text-sm font-medium text-gray-700">Kalori (kkal)</label>
            <input type="number" name="calories" id="calories" value="{{ old('calories', $recipe->kalori) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Protein -->
        <div class="mb-4">
            <label for="protein" class="block text-sm font-medium text-gray-700">Protein (g)</label>
            <input type="number" name="protein" id="protein" value="{{ old('protein', $recipe->protein) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Karbohidrat -->
        <div class="mb-4">
            <label for="carbs" class="block text-sm font-medium text-gray-700">Karbohidrat (g)</label>
            <input type="number" name="carbs" id="carbs" value="{{ old('carbs', $recipe->carbs) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Lemak -->
        <div class="mb-4">
            <label for="fat" class="block text-sm font-medium text-gray-700">Lemak (g)</label>
            <input type="number" name="fat" id="fat" value="{{ old('fat', $recipe->fat) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Waktu Masak -->
        <div class="mb-4">
            <label for="time" class="block text-sm font-medium text-gray-700">Waktu Masak (menit)</label>
            <input type="text" name="time" id="time" value="{{ old('time', $recipe->waktu_masak) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Tag Nutrisi -->
        <div class="mb-4">
            <label for="tag" class="block text-sm font-medium text-gray-700">Tag Nutrisi</label>
            <input type="text" name="tag" id="tag" value="{{ old('tag', $recipe->tag_nutrisi) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Bahan -->
        <div class="mb-4">
            <label for="ingredients" class="block text-sm font-medium text-gray-700">Bahan</label>
            <textarea name="ingredients" id="ingredients" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('ingredients', $recipe->bahan) }}</textarea>
        </div>

        <!-- Langkah -->
        <div class="mb-4">
            <label for="instructions" class="block text-sm font-medium text-gray-700">Langkah</label>
            <textarea name="instructions" id="instructions" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('instructions', $recipe->langkah) }}</textarea>
        </div>

        <!-- Gambar -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @if ($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="Gambar Resep" class="mt-2 w-32 h-32 object-cover rounded-md">
            @endif
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan Perubahan</button>
    </form>
</div>
@endsection