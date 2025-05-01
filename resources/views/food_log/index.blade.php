@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-semibold">Riwayat Konsumsi Gizi</h3>

    {{-- Filter Buttons --}}
    <div class="btn-group mb-4" role="group">
        <a href="{{ route('food_log.index', ['filter' => 'harian']) }}" class="btn {{ $filter == 'harian' ? 'btn-success text-white' : 'btn-outline-secondary' }}">
            Hari Ini
        </a>
        <a href="{{ route('food_log.index', ['filter' => 'mingguan']) }}" class="btn {{ $filter == 'mingguan' ? 'btn-success text-white' : 'btn-outline-secondary' }}">
            Minggu Ini
        </a>
        <a href="{{ route('food_log.index', ['filter' => 'bulankalender']) }}" class="btn {{ $filter == 'bulankalender' ? 'btn-success text-white' : 'btn-outline-secondary' }}">
            Bulan Ini
        </a>
    </div>

    {{-- Nutrient Summary --}}
    <div class="row mb-4">
        @php
            function getProgress($value, $target) {
                return min(100, round(($value / $target) * 100));
            }
        @endphp

        @foreach ([
            ['label' => 'Kalori', 'unit' => 'kcal', 'value' => $intake->calories, 'target' => $target->calories, 'color' => 'warning', 'icon' => '🔥'],
            ['label' => 'Protein', 'unit' => 'g', 'value' => $intake->protein, 'target' => $target->protein, 'color' => 'primary', 'icon' => '💧'],
            ['label' => 'Karbohidrat', 'unit' => 'g', 'value' => $intake->carbs, 'target' => $target->carbs, 'color' => 'warning', 'icon' => '🍞'],
            ['label' => 'Lemak', 'unit' => 'g', 'value' => $intake->fat, 'target' => $target->fat, 'color' => 'purple', 'icon' => '🧈'],
        ] as $item)
        <div class="col-md-3">
            <div class="card shadow-sm mb-3 border-0">
                <div class="card-body">
                    <h6 class="fw-bold text-muted">{{ $item['label'] }} <span>{{ $item['icon'] }}</span></h6>
                    <h4>{{ number_format($item['value']) }} <small class="text-muted">/ {{ $item['target'] }} {{ $item['unit'] }}</small></h4>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-{{ $item['color'] }}"
                            style="width: {{ getProgress($item['value'], $item['target']) }}%;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Add Food Button --}}
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5>Riwayat Makanan</h5>
        <a href="{{ route('food_log.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i>Tambah Makanan</a>
    </div>

    {{-- Food Logs --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            @forelse ($foodLogs as $log)
                <div class="d-flex align-items-center justify-content-between border-bottom px-3 py-3">
                    <div class="d-flex align-items-start">
                        <div class="bg-light rounded p-2 me-3">
                            <i class="bi bi-emoji-smile fs-4 text-secondary"></i>
                        </div>
                        <div>
                            <div class="fw-semibold">{{ $log->food_name }}</div>
                            <small class="text-muted">Porsi: {{ $log->portion }} • {{ \Carbon\Carbon::parse($log->consumed_at)->format('H:i') }} WIB</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="fw-semibold">{{ $log->calories }} kcal</div>
                        <div class="mt-1">
                            <a href="{{ route('food_log.edit', $log->id) }}" class="text-primary me-2"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('food_log.destroy', $log->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus makanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-3 text-muted">Belum ada data makanan untuk periode ini.</div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $foodLogs->withQueryString()->links() }}
    </div>
</div>
@endsection
