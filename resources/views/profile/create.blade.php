@extends('layouts.tailwind-app')

@section('content')
<div class="container mx-auto py-5">
    <h2 class="text-center text-2xl font-semibold mb-6">Lengkapi Profil Anda</h2>
    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg p-2 mt-1" value="{{ old('name') }}" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-lg p-2 mt-1" value="{{ old('email') }}" required>
            </div>
            <div class="mb-4">
                <label for="age" class="block text-sm font-medium text-gray-700">Usia</label>
                <input type="number" name="age" id="age" class="w-full border border-gray-300 rounded-lg p-2 mt-1" value="{{ old('age') }}" required min="1" max="120">
            </div>
            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="gender" id="gender" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Lainnya" {{ old('gender') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="height" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm)</label>
                <input type="number" name="height" id="height" class="w-full border border-gray-300 rounded-lg p-2 mt-1" value="{{ old('height') }}" required min="50" max="250">
            </div>
            <div class="mb-4">
                <label for="weight" class="block text-sm font-medium text-gray-700">Berat Badan (kg)</label>
                <input type="number" step="0.1" name="weight" id="weight" class="w-full border border-gray-300 rounded-lg p-2 mt-1" value="{{ old('weight') }}" required min="20" max="300">
            </div>
        </div>

        <div class="mb-4">
            <label for="activity_level" class="block text-sm font-medium text-gray-700">Tingkat Aktivitas</label>
            <select name="activity_level" id="activity_level" class="w-full border border-gray-300 rounded-lg p-2 mt-1" required>
                <option value="Sangat Aktif" {{ old('activity_level') == 'Sangat Aktif' ? 'selected' : '' }}>Sangat Aktif</option>
                <option value="Cukup Aktif" {{ old('activity_level') == 'Cukup Aktif' ? 'selected' : '' }}>Cukup Aktif</option>
                <option value="Kurang Aktif" {{ old('activity_level') == 'Kurang Aktif' ? 'selected' : '' }}>Kurang Aktif</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Preferensi Diet</label>
            <div class="space-y-2">
                <div class="flex items-center">
                    <input class="form-checkbox" type="checkbox" name="diet[]" value="Vegetarian" {{ is_array(old('diet')) && in_array('Vegetarian', old('diet')) ? 'checked' : '' }}>
                    <label class="ml-2 text-sm">Vegetarian</label>
                </div>
                <div class="flex items-center">
                    <input class="form-checkbox" type="checkbox" name="diet[]" value="Rendah Kalori" {{ is_array(old('diet')) && in_array('Rendah Kalori', old('diet')) ? 'checked' : '' }}>
                    <label class="ml-2 text-sm">Rendah Kalori</label>
                </div>
                <div class="flex items-center">
                    <input class="form-checkbox" type="checkbox" name="diet[]" value="Bebas gluten" {{ is_array(old('diet')) && in_array('Bebas gluten', old('diet')) ? 'checked' : '' }}>
                    <label class="ml-2 text-sm">Bebas Gluten</label>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label for="profile_photo" class="block text-sm font-medium text-gray-700">Foto Profil</label>
            <input type="file" name="profile_photo" id="profile_photo" class="w-full border border-gray-300 rounded-lg p-2 mt-1">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Simpan Profil</button>
    </form>
</div>
@endsection
