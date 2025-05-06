@extends('layouts.tailwind-app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-blue-700">HealthyCalc</h1>
    </div>

    {{-- Ringkasan Nutrisi --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <p class="text-gray-500">Total Kalori</p>
            <p class="text-3xl font-extrabold text-blue-600">{{ number_format($totalCalories, 2, ',', '.') }}</p>
            <p class="text-sm text-gray-500">dari {{ number_format($targetCalories, 2, ',', '.') }} kal</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <p class="text-gray-500">Protein</p>
            <p class="text-3xl font-extrabold text-green-600">{{ number_format($totalProtein, 2, ',', '.') }}g</p>
            <p class="text-sm text-gray-500">dari {{ number_format($targetProtein, 2, ',', '.') }}g</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <p class="text-gray-500">Karbohidrat</p>
            <p class="text-3xl font-extrabold text-purple-600">{{ number_format($totalCarbs, 2, ',', '.') }}g</p>
            <p class="text-sm text-gray-500">dari {{ number_format($targetCarbs, 2, ',', '.') }}g</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <p class="text-gray-500">Lemak</p>
            <p class="text-3xl font-extrabold text-pink-600">{{ number_format($totalFat, 2, ',', '.') }}g</p>
            <p class="text-sm text-gray-500">dari {{ number_format($targetFat, 2, ',', '.') }}g</p>
        </div>
    </div>

    {{-- Tombol Tambah --}}
    <div class="text-center mb-6">
        <a href="{{ route('food-intakes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            + Tambah Makanan
        </a>
    </div>

    {{-- Riwayat Asupan --}}
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Riwayat Asupan Hari Ini</h2>

        @forelse ($intakes as $intake)
            <div class="bg-gray-50 rounded-lg p-4 shadow-sm mb-4 hover:shadow-md transition">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $intake->food_name }}</h3>
                        <p class="text-sm text-gray-500">
                            Kalori: <span class="font-medium text-blue-600">{{ number_format($intake->calories, 2, ',', '.') }} kkal</span><br>
                            Protein: <span class="text-green-600">{{ number_format($intake->protein, 2, ',', '.') }}g</span> |
                            Karbo: <span class="text-purple-600">{{ number_format($intake->carbs ?? $intake->carbohydrate, 2, ',', '.') }}g</span> |
                            Lemak: <span class="text-pink-600">{{ number_format($intake->fat, 2, ',', '.') }}g</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-1">Waktu konsumsi: {{ \Carbon\Carbon::parse($intake->consumed_at)->format('d M Y H:i') }}</p>

                        @if ($intake->meal_time)
                            <span class="mt-2 inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">
                                {{ ucfirst($intake->meal_time) }}
                            </span>
                        @endif
                    </div>
                    <div class="text-right mt-1">
                        <a href="{{ route('food-intakes.edit', $intake->id) }}" class="text-sm text-blue-500 hover:underline mr-2">Edit</a>
                        <form action="{{ route('food-intakes.destroy', $intake->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600">Belum ada data asupan makanan hari ini.</p>
        @endforelse
    </div>
</div>
@endsection
