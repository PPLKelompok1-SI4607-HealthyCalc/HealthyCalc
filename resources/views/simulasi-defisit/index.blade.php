@extends('layouts.app')

@section('title', 'Daftar Simulasi Defisit')

@section('content')
<div class="row">
    <!-- Sidebar Section -->
    <div class="col-md-3">
        <div class="card shadow-lg mb-4">
            <div class="card-header bg-info text-white">
                <h5 style="font-weight: 700;">Status Berat dan Kalori Saya</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-person-circle" style="font-size: 2rem; margin-right: 10px;"></i>
                    <div>
                        <strong>Berat:</strong> 70 kg
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-fire" style="font-size: 2rem; margin-right: 10px; color: #ff6f61;"></i>
                    <div>
                        <strong>Kalori:</strong> 2000 kkal
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="col-md-9">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white">
                <h3 style="font-weight: 700; margin-bottom: 15px;">Daftar Simulasi Defisit</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <a href="{{ route('simulasi-defisit.create') }}" class="btn btn-primary mb-3" style="font-weight: 500; transition: background-color 0.3s ease, transform 0.2s ease;">Tambah Simulasi</a>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="font-weight: 700;">Target Berat</th>
                            <th style="font-weight: 700;">Durasi</th>
                            <th style="font-weight: 700;">Kebutuhan Kalori</th>
                            <th style="font-weight: 700;">Rekomendasi Aktivitas</th>
                            <th style="font-weight: 700;">Tingkat Aktivitas</th>
                            <th style="font-weight: 700;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($simulasi as $item)
                        <tr class="table-row-hover">
                            <td>{{ $item->target_berat }}</td>
                            <td>{{ $item->durasi }}</td>
                            <td>{{ $item->kebutuhan_kalori }}</td>
                            <td>{{ $item->rekomendasi_aktivitas }}</td>
                            <td>{{ $item->tingkat_aktivitas }}</td>
                            <td>
                                <a href="{{ route('simulasi-defisit.edit', $item->id) }}" class="btn btn-warning btn-sm" style="font-weight: 500;" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('simulasi-defisit.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus simulasi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="font-weight: 500;" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-primary:hover {
        background-color: #27ae60 !important;
        transform: scale(1.05);
    }

    .table-row-hover:hover {
        background-color: #f2f2f2;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection