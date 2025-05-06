@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-4">Edit Perhitungan Kalori</h2>

    <form action="{{ route('kalori.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Usia -->
        <div class="mb-4">
            <label for="age" class="block text-sm font-medium text-gray-700">Usia</label>
            <input type="number" name="age" id="age" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('age', $profile->age ?? '') }}" required>
        </div>

        <!-- Jenis Kelamin -->
        <div class="mb-4">
            <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="Laki-laki" {{ old('gender', $profile->gender) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('gender', $profile->gender) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <!-- Tinggi Badan -->
        <div class="mb-4">
            <label for="height" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm)</label>
            <input type="number" name="height" id="height" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('height', $profile->height ?? '') }}" required>
        </div>

        <!-- Berat Badan -->
        <div class="mb-4">
            <label for="weight" class="block text-sm font-medium text-gray-700">Berat Badan (kg)</label>
            <input type="number" name="weight" id="weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('weight', $profile->weight ?? '') }}" required>
        </div>

        <!-- Tingkat Aktivitas -->
        <div class="mb-4">
            <label for="activity_level" class="block text-sm font-medium text-gray-700">Tingkat Aktivitas</label>
            <select name="activity_level" id="activity_level" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="Sangat Aktif" {{ old('activity_level', $profile->activity_level) === 'Sangat Aktif' ? 'selected' : '' }}>Sangat Aktif</option>
                <option value="Cukup Aktif" {{ old('activity_level', $profile->activity_level) === 'Cukup Aktif' ? 'selected' : '' }}>Cukup Aktif</option>
                <option value="Kurang Aktif" {{ old('activity_level', $profile->activity_level) === 'Kurang Aktif' ? 'selected' : '' }}>Kurang Aktif</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan Perubahan</button>
    </form>
</div>
@endsection