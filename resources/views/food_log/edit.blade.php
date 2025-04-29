@extends('layouts.app')

@section('content')
<div class="nutrition-summary">
    <h2 class="mb-4">Edit Makanan</h2>

    <form action="{{ route('food_log.update', $foodLog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="food_name" class="form-label">Nama Makanan</label>
            <input type="text" class="form-control" id="food_name" name="food_name" value="{{ $foodLog->food_name }}" required>
        </div>

        <div class="mb-3">
            <label for="portion" class="form-label">Porsi</label>
            <input type="text" class="form-control" id="portion" name="portion" value="{{ $foodLog->portion }}" required>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="calories" class="form-label">Kalori (kcal)</label>
                <input type="number" class="form-control" id="calories" name="calories" value="{{ $foodLog->calories }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="protein" class="form-label">Protein (g)</label>
                <input type="number" step="0.1" class="form-control" id="protein" name="protein" value="{{ $foodLog->protein }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="carbs" class="form-label">Karbohidrat (g)</label>
                <input type="number" step="0.1" class="form-control" id="carbs" name="carbs" value="{{ $foodLog->carbs }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="fat" class="form-label">Lemak (g)</label>
                <input type="number" step="0.1" class="form-control" id="fat" name="fat" value="{{ $foodLog->fat }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="consumed_at" class="form-label">Waktu Konsumsi</label>
            <input type="datetime-local" class="form-control" id="consumed_at" name="consumed_at" 
                   value="{{ date('Y-m-d\TH:i', strtotime($foodLog->consumed_at)) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('food_log.index') }}" class="btn btn-outline-secondary">Batal</a>
    </form>
</div>
@endsection