@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Riwayat Konsumsi Gizi</h2>

    {{-- Filter Buttons --}}
    <div class="flex gap-3 mb-6">
        <a href="{{ route('food_log.index', ['filter' => 'harian']) }}" 
           class="px-4 py-2 rounded-lg text-lg font-sans {{ $filter == 'harian' ? 'bg-green-500 text-white border border-green-500' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50' }}">
            Hari Ini
        </a>
        <a href="{{ route('food_log.index', ['filter' => 'mingguan']) }}" 
           class="px-4 py-2 rounded-lg text-lg font-sans {{ $filter == 'mingguan' ? 'bg-green-500 text-white border border-green-500' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50' }}">
            Minggu Ini
        </a>
        <a href="{{ route('food_log.index', ['filter' => 'bulankalender']) }}" 
           class="px-4 py-2 rounded-lg text-lg font-sans {{ $filter == 'bulankalender' ? 'bg-green-500 text-white border border-green-500' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50' }}">
            Bulan Ini
        </a>
    </div>

    {{-- Nutrient Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        @foreach ([
            ['label' => 'Kalori', 'unit' => 'kcal', 'value' => $intake->calories, 'target' => $target->calories, 'color' => 'bg-yellow-400', 'icon' => '🔥'],
            ['label' => 'Protein', 'unit' => 'g', 'value' => $intake->protein, 'target' => $target->protein, 'color' => 'bg-blue-500', 'icon' => '💧'],
            ['label' => 'Karbohidrat', 'unit' => 'g', 'value' => $intake->carbs, 'target' => $target->carbs, 'color' => 'bg-yellow-500', 'icon' => '🍞'],
            ['label' => 'Lemak', 'unit' => 'g', 'value' => $intake->fat, 'target' => $target->fat, 'color' => 'bg-purple-500', 'icon' => '🧈']
        ] as $item)
        <div class="bg-white shadow-xl rounded-lg p-6 transition-transform transform hover:scale-105 hover:shadow-2xl">
            <div class="text-sm text-gray-500 font-semibold mb-1 flex items-center justify-between">
                <span>{{ $item['label'] }}</span>
                <span>{{ $item['icon'] }}</span>
            </div>
            <div class="text-2xl font-bold text-gray-800">
                {{ number_format($item['value']) }} 
                <span class="text-sm text-gray-500 font-normal">/ {{ $item['target'] }} {{ $item['unit'] }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                <div class="{{ $item['color'] }} h-2 rounded-full" style="width: {{ min(100, round(($item['value'] / $item['target']) * 100)) }}%;"></div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Header and Add Button --}}
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Riwayat Makanan</h3>
        <a href="{{ route('food_log.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
            <span class="mr-2">🍽️</span> Tambah Makanan
        </a>
    </div>

    {{-- Food Logs --}}
    <div class="bg-white shadow-lg rounded-lg divide-y">
        @forelse ($foodLogs as $log)
        <div class="flex justify-between items-start p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-start gap-4">
                <div class="bg-gray-100 p-2 rounded-full flex items-center justify-center w-12 h-12">
                    <span class="text-xl text-gray-500">🍽️</span> {{-- Ikon makanan menggunakan emoji 🍽️ --}}
                </div>
                <div>
                    <div class="font-semibold text-gray-800">{{ $log->food_name }}</div>
                    <div class="text-sm text-gray-500">Porsi: {{ $log->portion }} • {{ \Carbon\Carbon::parse($log->consumed_at)->format('H:i') }} WIB</div>
                </div>
            </div>
            <div class="text-right">
                <div class="font-semibold text-gray-700">{{ $log->calories }} kcal</div>
                <div class="mt-2 flex gap-2 justify-end">
                    <a href="{{ route('food_log.edit', $log->id) }}" class="text-blue-500 hover:text-blue-600 text-sm"><i class="bi bi-pencil-square mr-1"></i>Edit</a>
                    <form action="{{ route('food_log.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus makanan ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600 text-sm btn-delete" data-id="{{ $log->id }}">
                            <i class="bi bi-trash-fill mr-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="p-4 text-gray-500">Belum ada data makanan untuk periode ini.</div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $foodLogs->withQueryString()->links() }}
    </div>
</div>
@endsection
