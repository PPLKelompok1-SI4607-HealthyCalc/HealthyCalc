@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Tambah Resep Makanan Sehat</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('recipes.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Resep</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Bahan-bahan</label>
            <textarea class="form-control" name="ingredients" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="instructions" class="form-label">Langkah-langkah</label>
            <textarea class="form-control" name="instructions" rows="3" required></textarea>
        </div>

        <div class="mb-3 row">
            <div class="col">
                <label for="calories">Kalori</label>
                <input type="number" class="form-control" name="calories">
            </div>
            <div class="col">
                <label for="protein">Protein</label>
                <input type="number" class="form-control" name="protein">
            </div>
            <div class="col">
                <label for="carbohydrate">Karbohidrat</label>
                <input type="number" class="form-control" name="carbohydrate">
            </div>
            <div class="col">
                <label for="fat">Lemak</label>
                <input type="number" class="form-control" name="fat">
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan Resep</button>
    </form>
</div>
@endsection
