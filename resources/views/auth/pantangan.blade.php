@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Makanan Pantangan</h2>

    <form action="#" method="POST" class="mb-4 d-flex gap-2">
        @csrf
        <input type="text" name="nama_makanan" placeholder="Nama Makanan" class="form-control" />
        <select name="kategori" class="form-select">
            <option value="">Pilih Kategori</option>
            <option value="Alergi">Alergi</option>
            <option value="Kesehatan">Kesehatan</option>
            <option value="Diet">Diet</option>
        </select>
        <button type="submit" class="btn btn-success">+ Tambah</button>
    </form>

    <div class="mb-4 d-flex gap-3">
        <div class="alert alert-danger">🔺 Alergi <br> {{ $kategoriCounts['Alergi'] }} makanan</div>
        <div class="alert alert-info">🩺 Kesehatan <br> {{ $kategoriCounts['Kesehatan'] }} makanan</div>
        <div class="alert alert-primary">📦 Diet <br> {{ $kategoriCounts['Diet'] }} makanan</div>
    </div>

    <h4>Daftar Makanan Pantangan</h4>
    <ul class="list-group">
        @foreach($pantangan as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <span class="me-2">
                        @if($item->kategori === 'Alergi')
                            🔴
                        @elseif($item->kategori === 'Kesehatan')
                            🔵
                        @elseif($item->kategori === 'Diet')
                            🟣
                        @endif
                    </span>
                    {{ $item->nama_makanan }}
                    <span class="badge bg-secondary">{{ $item->kategori }}</span>
                </div>
                <div>
                    <a href="#" class="btn btn-sm btn-outline-secondary">✏️</a>
                    <a href="#" class="btn btn-sm btn-outline-danger">🗑️</a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
