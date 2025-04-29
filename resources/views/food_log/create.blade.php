@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Tambah Makanan</h2>

    <form action="{{ route('food_log.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="food_name" class="form-label">Nama Makanan</label>
            <input type="text" name="food_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Porsi</label>
            <input type="text" name="portion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kalori</label>
            <input type="number" name="calories" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Protein</label>
            <input type="number" name="protein" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Karbohidrat</label>
            <input type="number" name="carbs" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Lemak</label>
            <input type="number" name="fat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Waktu Konsumsi</label>
            <input type="datetime-local" name="consumed_at" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection
