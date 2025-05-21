@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">
        {{ isset($editPantangan) ? 'Edit Makanan Pantangan' : 'Tambah Makanan Pantangan' }}
    </h2>

    <form action="{{ isset($editPantangan) ? route('pantangan.update', $editPantangan->id) : route('pantangan.store') }}"
          method="POST" class="mb-4 d-flex gap-2">
        @csrf

        <input type="text" name="nama_makanan"
               value="{{ isset($editPantangan) ? $editPantangan->nama_makanan : old('nama_makanan') }}"
               placeholder="Nama Makanan" class="form-control" required />

        <select name="kategori" class="form-select" required>
            <option value="">Pilih Kategori</option>
            <option value="Alergi" {{ (isset($editPantangan) && $editPantangan->kategori == 'Alergi') ? 'selected' : '' }}>Alergi</option>
            <option value="Kesehatan" {{ (isset($editPantangan) && $editPantangan->kategori == 'Kesehatan') ? 'selected' : '' }}>Kesehatan</option>
            <option value="Diet" {{ (isset($editPantangan) && $editPantangan->kategori == 'Diet') ? 'selected' : '' }}>Diet</option>
        </select>

        <button type="submit" class="btn btn-{{ isset($editPantangan) ? 'primary' : 'success' }}">
            {{ isset($editPantangan) ? 'Update' : '+ Tambah' }}
        </button>

        @if(isset($editPantangan))
            <a href="{{ route('pantangan.index') }}" class="btn btn-secondary">Batal</a>
        @endif
    </form>

    <div class="mb-4 d-flex gap-3">
        <div class="alert alert-danger flex-fill">🔺 Alergi <br> {{ $kategoriCounts['Alergi'] }} makanan</div>
        <div class="alert alert-info flex-fill">🩺 Kesehatan <br> {{ $kategoriCounts['Kesehatan'] }} makanan</div>
        <div class="alert alert-primary flex-fill">📦 Diet <br> {{ $kategoriCounts['Diet'] }} makanan</div>
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
                <div class="d-flex gap-2">
                    <a href="{{ route('pantangan.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">✏️</a>
                    <form action="{{ route('pantangan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">🗑️</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
