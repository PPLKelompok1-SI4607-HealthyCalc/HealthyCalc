@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Hasil Perhitungan Kalori & Nutrisi</h2>
    
    <ul class="space-y-4 text-lg text-gray-700">
        <li class="flex justify-between">
            <span class="font-medium">BMR (Kebutuhan Kalori Dasar):</span>
            <span class="text-gray-900">{{ number_format($bmr) }} kcal</span>
        </li>
        <li class="flex justify-between">
            <span class="font-medium">TDEE (Total Kebutuhan Energi Harian):</span>
            <span class="text-gray-900">{{ number_format($tdee) }} kcal</span>
        </li>
        <li class="flex justify-between text-xl font-semibold">
            <span class="font-medium">Kalori Disesuaikan dengan Tujuan:</span>
            <span class="text-green-500">{{ number_format($total_kalori) }} kcal</span>
        </li>
    </ul>
</div>
@endsection
