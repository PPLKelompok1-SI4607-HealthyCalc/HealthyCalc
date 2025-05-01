@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Makanan</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error umum --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('food_log.update', $foodLog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="food_name" class="form-label">Nama Makanan</label>
            <input type="text" class="form-control" id="food_name" name="food_name"
                   value="{{ old('food_name', $foodLog->food_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="portion" class="form-label">Porsi</label>
            <input type="text" class="form-control" id="portion" name="portion"
                   value="{{ old('portion', $foodLog->portion) }}" required>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="calories" class="form-label">Kalori (kcal)</label>
                <input type="number" class="form-control" id="calories" name="calories"
                       value="{{ old('calories', $foodLog->calories) }}" min="0" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="protein" class="form-label">Protein (g)</label>
                <input type="number" step="0.1" class="form-control" id="protein" name="protein"
                       value="{{ old('protein', $foodLog->protein) }}" min="0" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="carbs" class="form-label">Karbohidrat (g)</label>
                <input type="number" step="0.1" class="form-control" id="carbs" name="carbs"
                       value="{{ old('carbs', $foodLog->carbs) }}" min="0" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="fat" class="form-label">Lemak (g)</label>
                <input type="number" step="0.1" class="form-control" id="fat" name="fat"
                       value="{{ old('fat', $foodLog->fat) }}" min="0" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="consumed_at" class="form-label">Waktu Konsumsi</label>
            <input type="datetime-local" class="form-control" id="consumed_at" name="consumed_at"
                   value="{{ old('consumed_at', optional(\Carbon\Carbon::parse($foodLog->consumed_at))->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('food_log.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
