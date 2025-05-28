@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Form Tambah --}}
    <div class="card p-4 mb-4 shadow-sm">
        <h5 class="mb-3 fw-bold">Tambah Makanan Pantangan</h5>
        <form action="{{ isset($editPantangan) ? route('pantangan.update', $editPantangan->id) : route('pantangan.store') }}"
              method="POST" class="row g-2 align-items-end">
            @csrf

            <div class="col-md-5">
                <input type="text" name="nama_makanan" class="form-control"
                       placeholder="Nama Makanan" required
                       value="{{ isset($editPantangan) ? $editPantangan->nama_makanan : old('nama_makanan') }}">
            </div>

            <div class="col-md-4">
                <select name="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Alergi" {{ (isset($editPantangan) && $editPantangan->kategori == 'Alergi') ? 'selected' : '' }}>🔺 Alergi</option>
                    <option value="Kesehatan" {{ (isset($editPantangan) && $editPantangan->kategori == 'Kesehatan') ? 'selected' : '' }}>💙 Kesehatan</option>
                    <option value="Diet" {{ (isset($editPantangan) && $editPantangan->kategori == 'Diet') ? 'selected' : '' }}>💜 Diet</option>
                </select>
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-success w-100">
                    {{ isset($editPantangan) ? '💾 Update' : '+ Tambah' }}
                </button>
                @if(isset($editPantangan))
                    <a href="{{ route('pantangan.index') }}" class="btn btn-secondary">Batal</a>
                @endif
            </div>
        </form>
    </div>

    {{-- Statistik Kategori --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="p-3 rounded bg-danger bg-opacity-10 border border-danger text-danger fw-bold">
                🔺 Alergi <br> {{ $kategoriCounts['Alergi'] }} makanan
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded bg-info bg-opacity-10 border border-info text-info fw-bold">
                💙 Kesehatan <br> {{ $kategoriCounts['Kesehatan'] }} makanan
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded bg-primary bg-opacity-10 border border-primary text-primary fw-bold">
                💜 Diet <br> {{ $kategoriCounts['Diet'] }} makanan
            </div>
        </div>
    </div>

    {{-- Daftar Makanan --}}
    <div class="card p-3 shadow-sm">
        <h5 class="mb-3">Daftar Makanan Pantangan</h5>
        <ul class="list-group list-group-flush">
            @forelse($pantangan as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        @if($item->kategori == 'Alergi')
                            <span class="text-danger fw-bold">🔺</span>
                        @elseif($item->kategori == 'Kesehatan')
                            <span class="text-info fw-bold">💙</span>
                        @elseif($item->kategori == 'Diet')
                            <span class="text-primary fw-bold">💜</span>
                        @endif
                        <span class="ms-2">{{ $item->nama_makanan }}</span>
                        <span class="badge bg-light border text-secondary ms-2">{{ $item->kategori }}</span>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('pantangan.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">✏️</a>
                        <form action="{{ route('pantangan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">🗑️</button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="list-group-item text-center text-muted">Belum ada data pantangan.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
