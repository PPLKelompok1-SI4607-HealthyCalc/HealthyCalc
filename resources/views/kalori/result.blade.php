@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-4">Hasil Perhitungan Kalori</h2>

    <p class="text-gray-700">
        Kalori Harian: <span class="font-bold text-blue-500">{{ number_format($calories, 2) }} kkal</span>
    </p>
    <p class="text-gray-700">
        Protein: <span class="font-bold text-blue-500">{{ number_format($protein, 2) }} gram</span>
    </p>
    <p class="text-gray-700">
        Karbohidrat: <span class="font-bold text-blue-500">{{ number_format($carbs, 2) }} gram</span>
    </p>
    <p class="text-gray-700">
        Lemak: <span class="font-bold text-blue-500">{{ number_format($fat, 2) }} gram</span>
    </p>

    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 block text-center">
            Kembali ke Dashboard
        </a>
        <a href="{{ route('food-intakes.create') }}" class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 block text-center mt-4">
            Tambah Asupan
        </a>
    </div>
</div>
@endsection