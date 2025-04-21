@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Resep Makanan Sehat</h2>

    @if($recipes->isEmpty())
        <p class="text-center">Belum ada resep yang ditambahkan.</p>
    @else
        <div class="row">
            @foreach ($recipes as $recipe)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm rounded-4">
                        <img src="{{ asset('storage/'.$recipe->image) }}" class="card-img-top" alt="{{ $recipe->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->name }}</h5>
                            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">Lihat Resep</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection