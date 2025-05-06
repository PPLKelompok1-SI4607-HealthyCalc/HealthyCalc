@extends('layouts.tailwind-app')

@section('title', 'Daftar Simulasi Defisit')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Simulasi Defisit Kalori</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('calorieDeficitPerDay'))
        <div class="bg-blue-100 text-blue-700 p-4 rounded mb-4">
            Defisit kalori harian yang diperlukan: <strong>{{ session('calorieDeficitPerDay') }} kkal</strong>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Tautan Simulasi Defisit Kalori -->
        <a href="{{ route('simulasi-defisit.index') }}" class="bg-white p-4 rounded shadow hover:shadow-md transition">
            <h3 class="text-lg font-bold">Simulasi Defisit Kalori</h3>
            <p class="text-sm text-gray-600">Hitung defisit kalori harian untuk mencapai berat badan target.</p>
        </a>
    </div>

    <form action="{{ route('simulasi-defisit.hitung') }}" method="POST" class="bg-white p-6 rounded shadow mt-4">
        @csrf

        <div class="mb-4">
            <label for="current_weight" class="block text-sm font-medium text-gray-700">Berat Badan Saat Ini (kg)</label>
            <input type="number" name="current_weight" id="current_weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="target_weight" class="block text-sm font-medium text-gray-700">Berat Badan Target (kg)</label>
            <input type="number" name="target_weight" id="target_weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="time_frame" class="block text-sm font-medium text-gray-700">Waktu yang Diharapkan (minggu)</label>
            <input type="number" name="time_frame" id="time_frame" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Hitung</button>
    </form>
</div>
@endsection
