@extends('layouts.app')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('recipes.index') }}"
                    class="text-decoration-none text-success">Resep</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $recipe->name }}</li>
        </ol>
    </nav>
    <div class="row m-3">
        <div class="card mb-3">
            <img src="{{ asset('img/' . ($recipe->image ?? 'makanan.jpeg')) }}" class="card-img-top" alt="Gambar resep"
                style="max-height: 200px; object-fit: cover;">
            <div class="card-body">
                <p class="badge text-bg-success">{{ $recipe->nutrition_type }}</p>
                <h5 class="card-title">{{ $recipe->name }}</h5>
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center gap-1">
                            <i class="bi bi-fire text-danger fs-6"></i>
                            <span class="fw-normal text-dark">{{ $recipe->calories }} kal</span>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <i class="bi bi-clock-fill text-secondary fs-6"></i>
                            <span class="fw-normal text-dark">{{ $recipe->time }}</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="ingridients" class="col-form-label">Bahan-bahan:</label>
                    <textarea class="form-control" id="ingridients" name="ingridients" readonly>{{ $recipe->ingridients }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="steps" class="col-form-label">Langkah-langkah:</label>
                    <textarea class="form-control" id="steps" name="steps" readonly>{{ $recipe->steps }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
