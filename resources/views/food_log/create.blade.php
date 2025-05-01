@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Tambah Makanan</h2>

    <!-- Menampilkan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Tambah Makanan -->
    <form action="{{ route('food_log.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="food_name" class="form-label">Nama Makanan</label>
            <input type="text" name="food_name" class="form-control" value="{{ old('food_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="portion" class="form-label">Porsi</label>
            <input type="text" name="portion" class="form-control" value="{{ old('portion') }}" required>
        </div>

        <div class="mb-3">
            <label for="calories" class="form-label">Kalori</label>
            <input type="number" name="calories" class="form-control" value="{{ old('calories') }}" required>
        </div>

        <div class="mb-3">
            <label for="protein" class="form-label">Protein</label>
            <input type="number" name="protein" class="form-control" value="{{ old('protein') }}" required>
        </div>

        <div class="mb-3">
            <label for="carbs" class="form-label">Karbohidrat</label>
            <input type="number" name="carbs" class="form-control" value="{{ old('carbs') }}" required>
        </div>

        <div class="mb-3">
            <label for="fat" class="form-label">Lemak</label>
            <input type="number" name="fat" class="form-control" value="{{ old('fat') }}" required>
        </div>

        <div class="mb-3">
            <label for="consumed_at" class="form-label">Waktu Konsumsi</label>
            <input type="datetime-local" name="consumed_at" class="form-control" value="{{ old('consumed_at') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection
