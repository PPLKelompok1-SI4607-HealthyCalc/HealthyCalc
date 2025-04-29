@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-8">
        <a href="{{ route('recipes.index') }}" class="text-green-600 hover:text-green-800 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Kembali ke Daftar Resep
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-green-600 text-white">
            <h2 class="text-xl font-bold">{{ isset($recipe) ? 'Edit Resep' : 'Tambah Resep Baru' }}</h2>
        </div>
        
        <form method="POST" action="{{ isset($recipe) ? route('recipes.update', $recipe['id']) : route('recipes.store') }}" class="p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Resep</label>
                    <input type="text" id="name" name="name" value="{{ $recipe['name'] ?? '' }}" 
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400" 
                        required>
                </div>
                
                <div>
                    <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">Tag Nutrisi</label>
                    <select id="tag" name="tag" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                        <option value="Diet" {{ isset($recipe) && $recipe['tag'] == 'Diet' ? 'selected' : '' }}>Diet</option>
                        <option value="Tinggi Protein" {{ isset($recipe) && $recipe['tag'] == 'Tinggi Protein' ? 'selected' : '' }}>Tinggi Protein</option>
                        <option value="Rendah Kalori" {{ isset($recipe) && $recipe['tag'] == 'Rendah Kalori' ? 'selected' : '' }}>Rendah Kalori</option>
                        <option value="Vegetarian" {{ isset($recipe) && $recipe['tag'] == 'Vegetarian' ? 'selected' : '' }}>Vegetarian</option>
                    </select>
                </div>
                
                <div>
                    <label for="calories" class="block text-sm font-medium text-gray-700 mb-1">Kalori (kal)</label>
                    <input type="number" id="calories" name="calories" value="{{ $recipe['calories'] ?? '' }}" 
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400" 
                        required>
                </div>
                
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Memasak (mis: 25 min)</label>
                    <input type="text" id="time" name="time" value="{{ $recipe['time'] ?? '' }}" 
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400" 
                        required>
                </div>
            </div>

            <div>
                <label for="ingredients" class="block text-sm font-medium text-gray-700 mb-1">Bahan-bahan</label>
                <textarea id="ingredients" name="ingredients" rows="4" 
                    class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400">{{ $recipe['ingredients'] ?? '' }}</textarea>
            </div>

            <div>
                <label for="instructions" class="block text-sm font-medium text-gray-700 mb-1">Instruksi Memasak</label>
                <textarea id="instructions" name="instructions" rows="6" 
                    class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400">{{ $recipe['instructions'] ?? '' }}</textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4">
                <a href="{{ route('recipes.index') }}" class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    {{ isset($recipe) ? 'Perbarui Resep' : 'Simpan Resep' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection