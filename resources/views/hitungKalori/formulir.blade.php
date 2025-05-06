@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h4 class="text-2xl font-semibold text-center text-gray-800 mb-6">Perhitungan Kalori</h4>
    <form action="{{ route('kalori.hitung') }}" method="POST">
        @csrf

        <!-- Usia -->
        <div class="mb-4">
            <label for="usia" class="block text-sm font-medium text-gray-700">Usia:</label>
            <input type="number" name="usia" id="usia" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Jenis Kelamin -->
        <div class="mb-4">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
        </div>

        <!-- Berat Badan -->
        <div class="mb-4">
            <label for="berat_badan" class="block text-sm font-medium text-gray-700">Berat Badan (kg):</label>
            <input type="number" name="berat_badan" id="berat_badan" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Tinggi Badan -->
        <div class="mb-4">
            <label for="tinggi_badan" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm):</label>
            <input type="number" name="tinggi_badan" id="tinggi_badan" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Tingkat Aktivitas -->
        <div class="mb-4">
            <label for="tingkat_aktivitas" class="block text-sm font-medium text-gray-700">Tingkat Aktivitas:</label>
            <select name="tingkat_aktivitas" id="tingkat_aktivitas" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="rendah">Rendah</option>
                <option value="sedang">Sedang</option>
                <option value="tinggi">Tinggi</option>
            </select>
        </div>

        <!-- Tujuan -->
        <div class="mb-4">
            <label for="tujuan" class="block text-sm font-medium text-gray-700">Tujuan:</label>
            <select name="tujuan" id="tujuan" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="turun">Turun Berat Badan</option>
                <option value="jaga">Menjaga Berat Badan</option>
                <option value="naik">Naik Berat Badan</option>
            </select>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="w-full py-3 bg-blue-500 text-white text-lg font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Hitung Sekarang
        </button>
    </form>
</div>
@endsection
