@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row mb-3">
                <div class="d-flex justify-content-between">
                    <p class="title py-2 fs-3 fw-bold">Riwayat Asupan</p>
                </div>
            </div>
            <div class="row my-4">
                <h4 class="text-center">Progress Nutrisi Mingguan</h4>
                <canvas id="weeklyChart" class="mx-auto w-25"></canvas>
            </div>
            <div class="row mb-2">
                <div class="container p-0">
                    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-4">
                        {{-- Total Kalori Terbakar --}}
                        <div class="col">
                            <div class="card w-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center ps-2">
                                        <p class="fs-6 fw-semibold text-secondary p-0 m-0">Total Protein</p>
                                        @if ($targetCalories)
                                            <div
                                                class="d-flex justify-content-between align-items-center p-0 mb-0 bg-tertiary rounded-3">
                                                <p class="fs-4 fw-bold m-0">
                                                    {{ $weeklyCalories ?? 0}}</p>
                                                <div class="alert alert-success rounded-circle py-2 px-3 border-0 ">
                                                    <i class="bi bi-clock text-success"></i>
                                                </div>
                                            </div>
                                            <p class="text-secondary fs-6 fw-normal p-0">dari
                                                {{ $targetCalories ?? 'Anda belum menghitung kalori' }} g</p>
                                            <div class="container p-0">
                                                <div class="progress" role="progressbar" aria-label="Success example"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success"
                                                        style="width: {{ $caloriesProgress ?? 0 }}%"></div>
                                                </div>
                                            </div>
                                        @else
                                            <p class="fs-6 fw-bold m-0 text-danger">Lakukan perhitungan kalori terlebih
                                                dahulu</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Protein --}}
                        <div class="col">
                            <div class="card w-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center ps-2">
                                        <p class="fs-6 fw-semibold text-secondary p-0 m-0">Total Protein</p>
                                        @if ($targetProtein)
                                            <div
                                                class="d-flex justify-content-between align-items-center p-0 mb-0 bg-tertiary rounded-3">
                                                <p class="fs-4 fw-bold m-0">
                                                    {{ $weeklyProtein ?? 0}}</p>
                                                <div class="alert alert-success rounded-circle py-2 px-3 border-0 ">
                                                    <i class="bi bi-clock text-success"></i>
                                                </div>
                                            </div>
                                            <p class="text-secondary fs-6 fw-normal p-0">dari
                                                {{ $targetProtein ?? 'Anda belum menghitung kalori' }} g</p>
                                            <div class="container p-0">
                                                <div class="progress" role="progressbar" aria-label="Success example"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success"
                                                        style="width: {{ $proteinProgress ?? 0 }}%"></div>
                                                </div>
                                            </div>
                                        @else
                                            <p class="fs-6 fw-bold m-0 text-danger">Lakukan perhitungan kalori terlebih
                                                dahulu</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Karbohidrat --}}
                        <div class="col">
                            <div class="card w-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center ps-2">
                                        <p class="fs-6 fw-semibold text-secondary p-0 m-0">Total Karbohidrat</p>
                                        @if ($targetCarbs)
                                            <div
                                                class="d-flex justify-content-between align-items-center p-0 mb-0 bg-tertiary rounded-3">
                                                <p class="fs-4 fw-bold m-0">
                                                    {{ $weeklyCarbs ?? 0}}</p>
                                                <div class="alert alert-success rounded-circle px-3 py-2 border-0">
                                                    <i class="bi bi-person-arms-up text-success"></i>
                                                </div>
                                            </div>
                                            <p class="text-secondary fs-6 fw-normal p-0">dari {{ $targetCarbs ?? 0 }} g</p>
                                            <div class="container p-0">
                                                <div class="progress" role="progressbar" aria-label="Success example"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success"
                                                        style="width: {{ $carbsProgress ?? 0 }}%"></div>
                                                </div>
                                            </div>
                                        @else
                                            <p class="fs-6 fw-bold m-0 text-danger">Lakukan perhitungan kalori terlebih
                                                dahulu</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Lemak --}}
                        <div class="col">
                            <div class="card w-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center ps-2">
                                        <p class="fs-6 fw-semibold text-secondary p-0 m-0">Total Lemak</p>
                                        @if ($targetFat)
                                            <div class="d-flex justify-content-between align-items-center p-0 mb-0 bg-tertiary rounded-3">
                                                <p class="fs-4 fw-bold m-0">{{ $weeklyFat }}</p>
                                                <div class="alert alert-success rounded-circle px-3 py-2 border-0">
                                                    <i class="bi bi-person-arms-up text-success"></i>
                                                </div>
                                            </div>
                                            <p class="text-secondary fs-6 fw-normal p-0">dari {{ $targetFat ?? 'Anda belum menghitung kalori' }} g</p>
                                            <div class="container p-0">
                                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: {{ $fatProgress ?? 0 }}%"></div>
                                                </div>
                                            </div>
                                        @else
                                            <p class="fs-6 fw-bold m-0 text-danger">Lakukan perhitungan kalori terlebih dahulu</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="card w-100 border-0 shadow-sm mx-2 p-2" style="width: 18rem;">
                    <div class="card-body p-1">
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari Aktivitas"
                                    aria-label="Search" aria-describedby="basic-addon1">
                            </div>
                            <div class="p-0 flex-grow-1 align-self-center">
                                <p class="m-0 py-2 text-center bg-success text-white  rounded-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="bi bi-calendar-plus me-2"></i>+ Buat Riwayat
                                    Asupan Baru</p>
                            </div>
                            {{-- Modal Create --}}
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action=" {{ route('intake-histories.store') }} " method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="community-title">Buat Riwayat Asupan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-0">
                                                    <label for="food_name" class="col-form-label">Nama Makanan:</label>
                                                    <input type="text" class="form-control" id="food_name"
                                                        name="food_name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="calories" class="col-form-label">Kalori:</label>
                                                    <input type="number" class="form-control" id="calories"
                                                        name="calories" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="protein" class="col-form-label">Protein:</label>
                                                    <input type="number" class="form-control" id="protein"
                                                        name="protein" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="carbs" class="col-form-label">Karbohidrat:</label>
                                                    <input type="number" class="form-control" id="carbs"
                                                        name="carbs" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="fat" class="col-form-label">Lemak:</label>
                                                    <input type="number" class="form-control" id="fat"
                                                        name="fat" required>
                                                </div>
                                                <select class="form-select mb-3" name="meal_time" required>
                                                    <option selected>Pilih Kategori</option>
                                                    <option value="Sarapan">Sarapan</option>
                                                    <option value="Makan Siang">Makan Siang</option>
                                                    <option value="Makan Malam">Makan Malam</option>
                                                    <option value="Camilan">Camilan</option>
                                                </select>
                                                <div class="mb-3">
                                                    <label for="consumed_at" class="col-form-label">Waktu
                                                        Konsumsi:</label>
                                                    <input type="datetime-local" class="form-control" id="consumed_at"
                                                        name="consumed_at">
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
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <h3 class="title py-2">Daftar riwayat Asupan </h3>
            </div>
            @forelse ($intakeHistories as $intakeHistory)
            @empty
                <div class="alert alert-info text-center mt-2">
                    <p class="fs-6 fw-semibold text-muted m-0">Belum ada riwayat asupan.</p>
                </div>
            @endforelse
            <div class="row mt-4 mx-auto" id="searchContent">
                @foreach ($intakeHistories as $intakeHistory)
                    <div class="card w-100 border-0 shadow-sm p-2 mb-3 search-item" style="width: 18rem;">
                        <div class="card-body p-2">
                            <div class="row d-flex align-items-center ps-2">
                                <div class="d-flex justify-content-start align-items-center px-0 py-2 mb-0 rounded-3">
                                    <div class="rounded-circle px-3 py-2 border-0 my-0 me-2">
                                        @if ($intakeHistory->meal_time == 'Sarapan')
                                            <i class="bi bi-brightness-alt-high-fill text-warning fs-5">
                                            </i>
                                        @elseif ($intakeHistory->meal_time == 'Makan Siang')
                                            <i class="bi bi-brightness-high-fill text-warning fs-5">
                                            </i>
                                        @elseif ($intakeHistory->meal_time == 'Makan Malam')
                                            <i class="bi bi-moon-fill text-info fs-5 ">
                                            </i>
                                        @elseif ($intakeHistory->meal_time == 'Camilan')
                                            <i class="bi bi-cup-fill text-secondary fs-5">
                                            </i>
                                        @endif
                                    </div>
                                    <div class="me-2 d-flex flex-column justify-content-center">
                                        <p class="m-0 fs-6 fw-semibold">{{ $intakeHistory->food_name }}</p>
                                        <p class="m-0 text-secondary-emphasis">
                                            {{ $intakeHistory->consumed_at }} -
                                            <span>{{ $intakeHistory->meal_time }}</span>
                                        </p>
                                    </div>
                                    <div class="ms-auto d-flex align-items-center me-2">
                                        <p class="fw-bold me-2 mb-0 ">{{ $intakeHistory->calories }} kal</p>
                                        <button class="btn btn-link text-dark p-0 m-0" type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editintakeHistoryModal-{{ $intakeHistory->id }}">
                                            <i class="bi bi-pencil-square me-2"></i>
                                        </button>
                                        <form action="{{ route('intake-histories.destroy', $intakeHistory->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link text-dark p-0 m-0" type="submit">
                                                <i class="bi bi-trash me-2"></i>
                                            </button>
                                        </form>

                                        {{-- Modal Edit --}}
                                        <div class="modal fade" id="editintakeHistoryModal-{{ $intakeHistory->id }}"
                                            tabindex="-1"
                                            aria-labelledby="editintakeHistoryModalLabel-{{ $intakeHistory->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('intake-histories.update', $intakeHistory->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="editintakeHistoryModalLabel-{{ $intakeHistory->id }}">
                                                                Perbarui Riwayat Asupan
                                                                {{ $intakeHistory->food_name }}
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="food_name" class="col-form-label">Nama
                                                                    Makanan:</label>
                                                                <input type="text" class="form-control" id="food_name"
                                                                    name="food_name"
                                                                    value="{{ $intakeHistory->food_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="calories"
                                                                    class="col-form-label">Kalori:</label>
                                                                <input type="number" class="form-control" id="calories"
                                                                    name="calories"
                                                                    value="{{ $intakeHistory->calories }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="protein"
                                                                    class="col-form-label">Protein:</label>
                                                                <input type="number" class="form-control" id="protein"
                                                                    name="protein" value="{{ $intakeHistory->protein }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="carbs"
                                                                    class="col-form-label">Karbohidrat:</label>
                                                                <input type="number" class="form-control" id="carbs"
                                                                    name="carbs" value="{{ $intakeHistory->carbs }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="fat"
                                                                    class="col-form-label">Lemak:</label>
                                                                <input type="number" class="form-control" id="fat"
                                                                    name="fat" value="{{ $intakeHistory->fat }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="meal_time" class="col-form-label">Waktu
                                                                    Makan:</label>
                                                                <select class="form-select" id="meal_time"
                                                                    name="meal_time" required>
                                                                    <option value="Sarapan"
                                                                        {{ $intakeHistory->meal_time == 'Sarapan' ? 'selected' : '' }}>
                                                                        Sarapan
                                                                    </option>
                                                                    <option value="Makan Siang"
                                                                        {{ $intakeHistory->meal_time == 'Makan Siang' ? 'selected' : '' }}>
                                                                        Makan Siang
                                                                    </option>
                                                                    <option value="Makan Malam"
                                                                        {{ $intakeHistory->meal_time == 'Makan Malam' ? 'selected' : '' }}>
                                                                        Makan Malam
                                                                    </option>
                                                                    <option value="Camilan"
                                                                        {{ $intakeHistory->meal_time == 'Camilan' ? 'selected' : '' }}>
                                                                        Camilan
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="consumed_at" class="col-form-label">Waktu
                                                                    Konsumsi:</label>
                                                                <input type="datetime-local" class="form-control"
                                                                    id="consumed_at" name="consumed_at"
                                                                    value="{{ $intakeHistory->consumed_at ? $intakeHistory->consumed_at : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection
