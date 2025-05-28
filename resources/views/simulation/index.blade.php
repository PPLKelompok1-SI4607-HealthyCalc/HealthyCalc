@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Form Input Simulasi --}}
        <div class="row">
            <div class="card w-100 border-0 shadow-sm p-2">
                <div class="card-body px-2 py-0">
                    <div class="row mb-2">
                        <p class="fs-4 fw-bold">Simulasi Defisit Kalori</p>
                    </div>
                    <form action="{{ route('simulations.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="height" class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" class="form-control" id="height" name="height"
                                value="{{ old('height') ?? $profile->height }}">
                        </div>
                        <div class="mb-2">
                            <label for="weight" class="form-label">Berat Badan Saat Ini (kg)</label>
                            <input type="number" class="form-control" id="weight" name="weight"
                                value="{{ old('weight') ?? $profile->weight }}">
                        </div>
                        <div class="mb-2">
                            <label for="activity_level" class="form-label">Tingkat Aktivitas</label>
                            <select class="form-select" id="activity_level" name="activity_level">
                                <option hidden>Pilih Tingkat Aktivitas</option>
                                <option value="Sangat Aktif"
                                    {{ $profile->activity_level == 'Sangat Aktif' ? 'selected' : '' }}>Sangat Aktif</option>
                                <option value="Cukup Aktif"
                                    {{ $profile->activity_level == 'Cukup Aktif' ? 'selected' : '' }}>Cukup Aktif</option>
                                <option value="Kurang Aktif"
                                    {{ $profile->activity_level == 'Kurang Aktif' ? 'selected' : '' }}>Kurang Aktif</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="target_weight" class="form-label">Target Berat Badan (kg)</label>
                            <input type="number" class="form-control" id="target_weight" name="target_weight"
                                value="{{ old('target_weight') }}" required>
                        </div>
                        <div class="mb-2">
                            <label for="calories" class="form-label">Asupan Kalori Saat Ini (kcal/hari)</label>
                            <input type="number" class="form-control" id="calories" name="calories"
                                value="{{ old('calories') }}" required>
                        </div>
                        <div class="mb-2">
                            <label for="target_calories" class="form-label">Target Kalori Harian (kcal/hari)</label>
                            <input type="number" class="form-control" id="target_calories" name="target_calories"
                                value="{{ old('target_calories') }}" required>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary w-100">Hitung & Simpan Simulasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Hasil Simulasi --}}
        <div class="row mt-5">
            <h4 class="fw-bold">Hasil Simulasi</h4>

            @forelse ($simulation as $simulation)
                <div class="card shadow-sm p-4 mb-4 w-100">
                    <div class="row text-center mb-4">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="text-muted mb-1"><i class="bi bi-calendar3"></i> Estimasi Waktu</div>
                            <h5 class="fw-bold text-primary">{{ $simulation->estimated_time }} Minggu</h5>
                            <small class="text-muted">untuk mencapai target</small>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="text-muted mb-1"><i class="bi bi-arrow-down-circle"></i> Perubahan per Minggu</div>
                            <h5 class="fw-bold text-primary">{{ $simulation->weekly_change }} kg</h5>
                            <small class="text-muted">penurunan berat badan</small>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted mb-1"><i class="bi bi-fire"></i> Target Kalori Harian</div>
                            <h5 class="fw-bold text-primary">{{ number_format($simulation->target_daily_calories) }} kcal
                            </h5>
                            <small class="text-muted">kalori per hari</small>
                        </div>
                    </div>

                    {{-- Rekomendasi --}}
                    <div class="d-flex flex-wrap gap-3 justify-content-center mb-3">
                        <div class="card shadow-sm p-3 flex-fill" style="min-width: 18rem;">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-egg-fried fs-4 text-primary me-2"></i>
                                <h6 class="mb-0">Pola Makan</h6>
                            </div>
                            <p class="mb-0 text-muted">
                                {{ $simulation->recommendation }}
                            </p>
                        </div>
                        <div class="card shadow-sm p-3 flex-fill" style="min-width: 18rem;">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-heart-pulse fs-4 text-primary me-2"></i>
                                <h6 class="mb-0">Aktivitas Fisik</h6>
                            </div>
                            <p class="mb-0 text-muted">
                                Lakukan cardio 3–4x/minggu dan latihan beban 2x/minggu untuk hasil optimal.
                            </p>
                        </div>
                    </div>

                    {{-- Edit & Delete --}}
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-link text-dark p-0 m-0" type="button" data-bs-toggle="modal"
                            data-bs-target="#editSimulationModal-{{ $simulation->id }}">
                            <i class="bi bi-pencil-fill text-primary"></i>
                        </button>

                        <form action="{{ route('simulations.destroy', $simulation->id) }}" method="POST"
                            class="m-0 ms-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link text-dark p-0 m-0" type="submit">
                                <i class="bi bi-trash-fill text-danger"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editSimulationModal-{{ $simulation->id }}" tabindex="-1"
                        aria-labelledby="editSimulationModalLabel-{{ $simulation->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('simulations.update', $simulation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Simulasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2">
                                            <label for="target_weight" class="form-label">Target Berat</label>
                                            <input type="number" class="form-control" name="target_weight"
                                                value="{{ $simulation->target_weight }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="calories" class="form-label">Asupan Kalori</label>
                                            <input type="number" class="form-control" name="calories"
                                                value="{{ $simulation->calories }}" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="target_calories" class="form-label">Target Kalori Harian</label>
                                            <input type="number" class="form-control" name="target_calories"
                                                value="{{ $simulation->target_calories }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center">
                    <p class="fs-6 fw-semibold text-muted m-0">Belum ada hasil simulasi.</p>
                </div>
            @endforelse
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
