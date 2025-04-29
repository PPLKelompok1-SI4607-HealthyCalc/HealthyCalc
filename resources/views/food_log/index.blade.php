@extends('layouts.app')

@section('content')
<div class="nutrition-summary">
    <h2 class="mb-4">Riwayat Konsumsi Gizi</h2>

    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('food_log.create') }}" class="btn btn-primary">+ Tambah Makanan</a>
        <div class="btn-group">
            <button class="btn btn-outline-secondary active">Hari ini</button>
            <button class="btn btn-outline-secondary">Minggu ini</button>
            <button class="btn btn-outline-secondary">Bulan ini</button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kalori</h5>
                    <h3>{{ $intake->calories }} / {{ $target->calories }} kcal</h3>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ ($intake->calories / $target->calories) * 100 }}%" 
                             aria-valuenow="{{ $intake->calories }}" 
                             aria-valuemin="0" 
                             aria-valuemax="{{ $target->calories }}"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Protein</h5>
                    <h3>{{ $intake->protein }} / {{ $target->protein }}g</h3>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-info" role="progressbar" 
                             style="width: {{ ($intake->protein / $target->protein) * 100 }}%" 
                             aria-valuenow="{{ $intake->protein }}" 
                             aria-valuemin="0" 
                             aria-valuemax="{{ $target->protein }}"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Karbohidrat</h5>
                    <h3>{{ $intake->carbs }} / {{ $target->carbs }}g</h3>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-warning" role="progressbar" 
                             style="width: {{ ($intake->carbs / $target->carbs) * 100 }}%" 
                             aria-valuenow="{{ $intake->carbs }}" 
                             aria-valuemin="0" 
                             aria-valuemax="{{ $target->carbs }}"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lemak</h5>
                    <h3>{{ $intake->fat }} / {{ $target->fat }}g</h3>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-danger" role="progressbar" 
                             style="width: {{ ($intake->fat / $target->fat) * 100 }}%" 
                             aria-valuenow="{{ $intake->fat }}" 
                             aria-valuemin="0" 
                             aria-valuemax="{{ $target->fat }}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Riwayat Makanan</h4>

    @foreach ($paginatedFoodLogs as $foodLog)
    <div class="food-item">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5>{{ $foodLog->food_name }}</h5>
                <p class="mb-1">{{ $foodLog->portion }} • {{ date('H:i', strtotime($foodLog->consumed_at)) }} WIB</p>
                <span class="badge bg-light text-dark">{{ $foodLog->calories }} kcal</span>
            </div>
            <div>
                <a href="{{ route('food_log.edit', $foodLog->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('food_log.destroy', $foodLog->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Pagination -->
    @if ($totalPages > 1)
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            @if ($currentPage > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ route('food_log.index', ['page' => $currentPage - 1]) }}">Previous</a>
                </li>
            @endif

            @for ($i = 1; $i <= $totalPages; $i++)
                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('food_log.index', ['page' => $i]) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($currentPage < $totalPages)
                <li class="page-item">
                    <a class="page-link" href="{{ route('food_log.index', ['page' => $currentPage + 1]) }}">Next</a>
                </li>
            @endif
        </ul>
    </nav>
    @endif
</div>
@endsection