@extends('layouts.app')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('food-plannings.index') }}"
                    class="text-decoration-none text-success">Rencana Makanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $foodPlanning->title }}</li>
        </ol>
    </nav>
    <div class="row mb-2">
        <div class="card w-100 border-0 shadow-sm p-2 mb-2" style="width: 18rem;">
            <div class="card-body p-2">
                <div class="row d-flex align-items-center mb-1 ps-2">
                    <div class="d-flex justify-content-start p-0">
                        <div class="mx-2 d-flex align-items-center">
                            @if ($foodPlanning->food_category == 'Sarapan')
                                <i class="bi bi-brightness-alt-high-fill text-warning fs-5">
                                    <span class="m-0 fw-semibold text-black fst-normal">
                                        {{ $foodPlanning->food_category }} di hari {{ $foodPlanning->day }} pukul
                                        {{ substr($foodPlanning->planned_time, 0, 5) }}</i>
                                </span>
                            @elseif ($foodPlanning->food_category == 'Makan Siang')
                                <i class="bi bi-brightness-high-fill text-warning fs-5">
                                    <span class="m-0 fw-semibold text-black fst-normal">
                                        {{ $foodPlanning->food_category }} di hari {{ $foodPlanning->day }} pukul
                                        {{ substr($foodPlanning->planned_time, 0, 5) }}</i>
                                </span>
                            @elseif ($foodPlanning->food_category == 'Makan Malam')
                                <i class="bi bi-moon-fill text-info fs-5 ">
                                    <span>
                                        {{ $foodPlanning->food_category }} di hari {{ $foodPlanning->day }} pukul
                                        {{ substr($foodPlanning->planned_time, 0, 5) }}</i>
                                </span>
                            @endif
                        </div>

                        <!-- Tombol Edit -->
                        <div class="ms-auto">
                            <button type="button" class="btn " data-bs-toggle="modal"
                                data-bs-target="#editFoodPlanningModal-{{ $foodPlanning->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editFoodPlanningModal-{{ $foodPlanning->id }}" tabindex="-1"
                            aria-labelledby="editFoodPlanningModalLabel-{{ $foodPlanning->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('food-plannings.update', $foodPlanning->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5"
                                                id="editFoodPlanningModalLabel-{{ $foodPlanning->id }}">
                                                Perbarui Rencana Makanan {{ $foodPlanning->title }}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="image" class="col-form-label">Gambar Makanan</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                            </div>
                                            <select class="form-select mb-3" name="food_category" required>
                                                <option disabled selected>Pilih Kategori</option>
                                                <option value="Sarapan"
                                                    {{ $foodPlanning->food_category == 'Sarapan' ? 'selected' : '' }}>
                                                    Sarapan</option>
                                                <option value="Makan Siang"
                                                    {{ $foodPlanning->food_category == 'Makan Siang' ? 'selected' : '' }}>
                                                    Makan Siang</option>
                                                <option value="Makan Malam"
                                                    {{ $foodPlanning->food_category == 'Makan Malam' ? 'selected' : '' }}>
                                                    Makan Malam</option>
                                            </select>
                                            <div class="mb-3">
                                                <label for="day" class="col-form-label">Hari:</label>
                                                <select class="form-select" name="day" required>
                                                    <option disabled selected>Pilih Hari</option>
                                                    <option value="Senin"
                                                        {{ $foodPlanning->day == 'Senin' ? 'selected' : '' }}>
                                                        Senin</option>
                                                    <option value="Selasa"
                                                        {{ $foodPlanning->day == 'Selasa' ? 'selected' : '' }}>
                                                        Selasa</option>
                                                    <option value="Rabu"
                                                        {{ $foodPlanning->day == 'Rabu' ? 'selected' : '' }}>
                                                        Rabu</option>
                                                    <option value="Kamis"
                                                        {{ $foodPlanning->day == 'Kamis' ? 'selected' : '' }}>
                                                        Kamis</option>
                                                    <option value="Jumat"
                                                        {{ $foodPlanning->day == 'Jumat' ? 'selected' : '' }}>
                                                        Jumat</option>
                                                    <option value="Sabtu"
                                                        {{ $foodPlanning->day == 'Sabtu' ? 'selected' : '' }}>
                                                        Sabtu</option>
                                                    <option value="Minggu"
                                                        {{ $foodPlanning->day == 'Minggu' ? 'selected' : '' }}>
                                                        Minggu</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="col-form-label">Judul:</label>
                                                <input type="text" class="form-control" name="title" required
                                                    value="{{ $foodPlanning->title }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="planned_time" class="col-form-label">Jam:</label>
                                                <input type="time" class="form-control" name="planned_time" required
                                                    value="{{ \Carbon\Carbon::parse($foodPlanning->planned_time)->format('H:i') }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="col-form-label">Deskripsi:</label>
                                                <textarea class="form-control" name="description" required>{{ $foodPlanning->description }}</textarea>
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
                        <div class="mx-2">
                            <form action="{{ route('food-plannings.destroy', $foodPlanning->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row d-flex align-items-center mb-1 ps-2">
                    <div class="d-flex justify-content-start p-0">
                        <div class="mx-2 d-flex align-items-center">
                            <img src="{{ asset('img/' . ($foodPlanning->image ?? 'makanan.jpeg')) }}" class="img-fluid"
                                style="width: 80px; height: 80px;" alt="{{ $foodPlanning->title }}">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <p class="m-0 fs-5 fw-bold">{{ $foodPlanning->title }}</p>
                            <p class="m-0 text-secondary-emphasis">{{ $foodPlanning->description }}</p>
                        </div>
                        <div class="ms-auto me-3 d-flex align-items-center">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
