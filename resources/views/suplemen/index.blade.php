@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row mb-4">
                <p class="title py-2 fs-3 fw-bold">Manajemen Konsumsi Suplemen</p>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3">
                    <div class="col">
                        <div class="p-3">
                            <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center mb-4 ps-2">
                                        <p class="fs-5 fw-semibold">Tambah Suplemen Baru</p>
                                        <form action=" {{ route('suplemens.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="suplemen_name"
                                                    class="col-form-label text-secondary fs-6 fw-semibold">Nama
                                                    Suplemen</label>
                                                <input type="text" class="form-control" id="suplemen_name"
                                                    name="suplemen_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="dosage"
                                                    class="col-form-label text-secondary fs-6 fw-semibold">Dosis (dalam
                                                    mg)</label>
                                                <input type="number" class="form-control" id="dosage" name="dosage"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="frequency"
                                                    class="col-form-label text-secondary fs-6 fw-semibold">Frekuensi</label>
                                                <select class="form-select" id="frequency" name="frequency" required>
                                                    <option selected>Pilih Frekuensi</option>
                                                    <option value="1x sehari">1x sehari</option>
                                                    <option value="2x sehari">2x sehari</option>
                                                    <option value="3x sehari">3x sehari</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success w-100">Tambah Suplemen</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Suplemen Aktif --}}
                    <div class="col">
                        <div class="p-3">
                            <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center ps-2">
                                        <p class="fs-5 fw-semibold">Suplemen Aktif</p>
                                        @if ($suplemens->count() > 0)
                                            @foreach ($suplemens as $suplemen)
                                                <div
                                                    class="d-flex justify-content-start px-0 py-2 mb-3 alert alert-success rounded-3">
                                                    <div class="mx-2 d-flex align-items-center">
                                                        <i class="bi bi-capsule-pill"></i>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="m-0 fs-6 fw-semibold">{{ $suplemen->suplemen_name }}</p>
                                                        <p class="m-0 text-secondary-emphasis">{{ $suplemen->dosage }}mg,
                                                            {{ $suplemen->frequency }}</p>
                                                    </div>
                                                    <div class="ms-auto d-flex align-items-center me-2">
                                                        <div class="dropdown dropend">
                                                            <button class="btn btn-link text-dark p-0 m-0" type="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical text-secondary"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <button type="button"
                                                                        class="dropdown-item d-flex align-items-center"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editsuplemenModal-{{ $suplemen->id }}">
                                                                        <i class="bi bi-pencil-square me-2"></i> Edit
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('suplemens.destroy', $suplemen->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button
                                                                            class="dropdown-item d-flex align-items-center text-danger"
                                                                            type="submit">
                                                                            <i class="bi bi-trash me-2"></i> Hapus
                                                                            </button>
                                                                        </form>

                                                                    {{-- <form
                                                                        action="{{ route('suplemens.destroy', $suplemen->id) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Yakin ingin menghapus suplemen ini?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button
                                                                            class="dropdown-item d-flex align-items-center text-danger"
                                                                            type="submit">
                                                                            <i class="bi bi-trash me-2"></i> Hapus
                                                                        </button>
                                                                    </form> --}}
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('suplemens.konsumsi', $suplemen->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button
                                                                            class="dropdown-item d-flex align-items-center text-success"
                                                                            type="submit">
                                                                            <i class="bi bi-check-circle me-2"></i> Tandai
                                                                            Sudah
                                                                            Konsumsi
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                            {{-- Modal Edit --}}
                                                            <div class="modal fade"
                                                                id="editsuplemenModal-{{ $suplemen->id }}" tabindex="-1"
                                                                aria-labelledby="editsuplemenModalLabel-{{ $suplemen->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <form
                                                                            action="{{ route('suplemens.update', $suplemen->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5"
                                                                                    id="editsuplemenModalLabel-{{ $suplemen->id }}">
                                                                                    Perbarui Konsumsi Suplemen
                                                                                    {{ $suplemen->title }}
                                                                                </h1>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Tutup"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="mb-3">
                                                                                    <label for="suplemen_name"
                                                                                        class="col-form-label text-secondary fs-6 fw-semibold">Nama
                                                                                        Suplemen</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="suplemen_name"
                                                                                        name="suplemen_name"
                                                                                        value="{{ $suplemen->suplemen_name }}"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="dosage"
                                                                                        class="col-form-label text-secondary fs-6 fw-semibold">Dosis
                                                                                        (dalam
                                                                                        mg)
                                                                                    </label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        id="dosage" name="dosage"
                                                                                        value="{{ $suplemen->dosage }}"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="frequency"
                                                                                        class="col-form-label text-secondary fs-6 fw-semibold">Frekuensi</label>
                                                                                    <select class="form-select"
                                                                                        id="frequency" name="frequency"
                                                                                        required>
                                                                                        <option disabled selected>Pilih
                                                                                            Frekuensi
                                                                                        </option>
                                                                                        <option value="1x sehari"
                                                                                            {{ $suplemen->frequency == '1x sehari' ? 'selected' : '' }}>
                                                                                            1x sehari
                                                                                        </option>
                                                                                        <option value="2x sehari"
                                                                                            {{ $suplemen->frequency == '2x sehari' ? 'selected' : '' }}>
                                                                                            2x sehari
                                                                                        </option>
                                                                                        <option value="3x sehari"
                                                                                            {{ $suplemen->frequency == '3x sehari' ? 'selected' : '' }}>
                                                                                            3x sehari
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Ubah</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </p>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-info text-center m-0">
                                                <p class="fs-6 fw-semibold text-muted m-0">Tidak ada suplemen.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Riwayat Konsumsi --}}
                    <div class="col">
                        <div class="p-3">
                            <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center ps-2">
                                        <p class="fs-5 fw-semibold">Riwayat Konsumsi</p>
                                        @if (count($suplemen_histories) > 0)
                                            @foreach ($suplemen_histories as $suplemen_history)
                                                <div class="d-flex justify-content-start p-0 mb-3 bg-tertiary rounded-3">
                                                    <div class="mx-2 d-flex align-items-center">
                                                        <i class="bi bi-capsule-pill"></i>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="m-0 fs-6 fw-semibold">
                                                            {{ $suplemen_history->suplemen->suplemen_name }}</p>
                                                        <p class="m-0 text-secondary-emphasis">
                                                            {{ $suplemen_history->formatted_time }}</p>
                                                    </div>
                                                    <div class="ms-auto d-flex align-items-center me-2">
                                                        <i class="bi bi-dot text-success fs-2"></i>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="alert alert-info text-center m-0">
                                                <p class="fs-6 fw-semibold text-muted m-0">Tidak ada riwayat.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
