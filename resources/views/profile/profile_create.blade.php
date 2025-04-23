@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-1">Pengaturan Profil</h2>
    <p class="mb-6 text-gray-600">Kelola informasi pribadi dan preferensi kesehatan Anda</p>

    <form action="{{ route('profile.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/100' }}" class="w-20 h-20 rounded-full object-cover" alt="Profile Photo">
                    <input type="file" name="photo" class="border border-gray-300 rounded px-3 py-2">
                </div>

                <div>
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div>
                    <label>Usia</label>
                    <input type="number" name="age" value="{{ old('age', $profile->age ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div>
                    <label>Tinggi (cm)</label>
                    <input type="number" name="height" value="{{ old('height', $profile->height ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div>
                    <label>Berat (kg)</label>
                    <input type="number" name="weight" value="{{ old('weight', $profile->weight ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div>
                    <label>Jenis Kelamin</label>
                    <select name="gender" class="w-full border border-gray-300 rounded px-3 py-2">
                        <option value="Laki-laki" {{ (old('gender', $profile->gender ?? '') == 'Laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ (old('gender', $profile->gender ?? '') == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block font-bold mb-1">Tingkat Aktivitas</label>
                    @foreach(['Sangat Aktif', 'Cukup Aktif', 'Kurang Aktif'] as $level)
                        <label class="block">
                            <input type="radio" name="activity_level" value="{{ $level }}" {{ (old('activity_level', $profile->activity_level ?? '') == $level) ? 'checked' : '' }}>
                            {{ $level }}
                        </label>
                    @endforeach
                </div>

                <div>
                    <label class="block font-bold mb-1">Preferensi Diet</label>
                    @foreach(['Vegetarian', 'Rendah Kalori', 'Bebas Gluten'] as $diet)
                        <label class="block">
                            <input type="checkbox" name="diet_preferences[]" value="{{ $diet }}"
                                {{ in_array($diet, old('diet_preferences', explode(',', $profile->diet_preferences ?? ''))) ? 'checked' : '' }}>
                            {{ $diet }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-right mt-6">
            <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
                ✔ Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection
