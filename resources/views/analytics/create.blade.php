@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Pengaturan Analitik</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('analytics.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Akhir</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Kategori Analitik</label>
            <select name="category" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="kalori">Kalori</option>
                <option value="protein">Protein</option>
                <option value="lemak">Lemak</option>
                <option value="karbohidrat">Karbohidrat</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="custom_target" class="form-label">Target Khusus (opsional)</label>
            <input type="number" name="custom_target" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
    </form>
</div>
@endsection
