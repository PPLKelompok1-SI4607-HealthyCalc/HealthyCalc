@extends('layouts.app')

@section('title', 'Tambah Simulasi Defisit')

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-success text-white">
        <h3 style="font-weight: 700; margin-bottom: 10px;">Tambah Simulasi Defisit</h3> <!-- Add margin-bottom -->
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('simulasi-defisit.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="target_berat" class="form-label" style="font-weight: 500;">Target Berat (kg):</label>
                <input type="number" name="target_berat" id="target_berat" class="form-control" required>
            </div>
            <div class="mb-4">
                <label for="durasi" class="form-label" style="font-weight: 500;">Durasi (hari):</label>
                <input type="number" name="durasi" id="durasi" class="form-control" required>
            </div>
            <div class="mb-4">
                <label for="tingkat_aktivitas" class="form-label" style="font-weight: 500;">Tingkat Aktivitas:</label>
                <select name="tingkat_aktivitas" id="tingkat_aktivitas" class="form-select">
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi">Tinggi</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>
    </div>
</div>
@endsection