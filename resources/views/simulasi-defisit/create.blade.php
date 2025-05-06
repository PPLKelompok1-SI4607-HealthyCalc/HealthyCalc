@extends('layouts.tailwind-app')

@section('title', 'Tambah Simulasi Defisit')

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <div class="bg-green-600 text-white px-4 py-3 rounded-t-lg mb-6">
        <h3 class="text-lg font-bold">Tambah Simulasi Defisit</h3>
    </div>

    @if($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul class="list-disc pl-5 space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('simulasi-defisit.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-4">
            <label for="target_berat" class="block text-sm font-medium text-gray-700">Target Berat (kg)</label>
            <input type="number" name="target_berat" id="target_berat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="durasi" class="block text-sm font-medium text-gray-700">Durasi (hari)</label>
            <input type="number" name="durasi" id="durasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="tingkat_aktivitas" class="block text-sm font-medium text-gray-700">Tingkat Aktivitas:</label>
            <select name="tingkat_aktivitas" id="tingkat_aktivitas"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                <option value="rendah">Rendah</option>
                <option value="sedang">Sedang</option>
                <option value="tinggi">Tinggi</option>
            </select>
        </div>

        <button type="submit"
            class="w-full bg-green-600 text-white font-semibold py-2 px-4 rounded hover:bg-green-700 transition duration-200">
            Simpan
        </button>
    </form>
</div>
@endsection
