@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row mb-4">
                <p class="title py-2 fs-3 fw-bold">Riwayat Aktivitas Fisik</p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="container p-0">
                <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3">
                    {{-- Total Kalori Terbakar --}}
                    <div class="col">
                        <div class="">
                            <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center ps-2">
                                        <p class="fs-6 fw-semibold text-secondary p-0 m-0">Total Kalori Terbakar</p>
                                        <div
                                            class="d-flex justify-content-between align-items-center p-0 mb-3 bg-tertiary rounded-3">
                                            <p class="fs-4 fw-bold m-0">{{ $weeklyCalories ?? 0 }} Kkal</p>
                                            <div class="alert alert-success rounded-circle px-3 py-2 border-0">
                                                <i class="bi bi-fire text-success"></i>
                                            </div>
                                        </div>
                                        <div class="container p-0">
                                            <div class="progress" role="progressbar" aria-label="Success example"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success"
                                                    style="width: {{ $caloriesProgress }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Durasi Total --}}
                    <div class="col">
                        <div class="">
                            <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center ps-2">
                                        <p class="fs-6 fw-semibold text-secondary p-0 m-0">Durasi Total</p>
                                        <div
                                            class="d-flex justify-content-between align-items-center p-0 mb-3 bg-tertiary rounded-3">
                                            <p class="fs-4 fw-bold m-0">{{ $weeklyMinutes ?? 0 }} Menit</p>
                                            <div class="alert alert-success rounded-circle py-2 px-3 border-0 ">
                                                <i class="bi bi-clock text-success"></i>
                                            </div>
                                        </div>
                                        <div class="container p-0">
                                            <div class="progress" role="progressbar" aria-label="Success example"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success" style="width: {{ $minutesProgress }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Aktivitas Minggu Ini --}}
                    <div class="col">
                        <div class="">
                            <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center ps-2">
                                        <p class="fs-6 fw-semibold text-secondary p-0 m-0">Aktivitas Minggu Ini</p>
                                        <div
                                            class="d-flex justify-content-between align-items-center p-0 mb-3 bg-tertiary rounded-3">
                                            <p class="fs-4 fw-bold m-0">{{ $weeklyActivities }} Aktivitas</p>
                                            <div class="alert alert-success rounded-circle px-3 py-2 border-0">
                                                <i class="bi bi-person-arms-up text-success"></i>
                                            </div>
                                        </div>
                                        <div class="container p-0">
                                            <div class="progress" role="progressbar" aria-label="Success example"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success "
                                                    style="width: {{ $activitiesProgress }}%"></div>
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
        <div class="row mt-2">
            <div class="card w-100 border-0 shadow-sm p-2 mt-2" style="width: 18rem;">
                <div class="card-body p-1">
                    <div class="d-flex">
                        <div class="p-2 flex-grow-1">
                            <input type="text" class="form-control" id="searchInput" placeholder="Cari Aktivitas"
                                aria-label="Search" aria-describedby="basic-addon1">
                        </div>
                        <div class="p-0 flex-grow-1 align-self-center">
                            <p class="m-0 py-2 text-center bg-success text-white  rounded-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">+ Tambah Aktivitas</p>
                        </div>
                        {{-- Modal Tambah --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action=" {{ route('activities.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="community-title">Buat Aktivitas Baru</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="intensity_level" class="col-form-label">Intensitas:</label>
                                                <select class="form-select" id="intensity_level" name="intensity_level"
                                                    required>
                                                    <option value="" selected hidden>Pilih Kategori</option>
                                                    <option value="Rendah">Rendah</option>
                                                    <option value="Sedang">Sedang</option>
                                                    <option value="Tinggi">Tinggi</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="activity_name" class="col-form-label">Nama Aktivitas:</label>
                                                <input type="text" class="form-control" id="activity_name"
                                                    name="activity_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="duration_minutes" class="col-form-label">Durasi
                                                    (menit):</label>
                                                <input type="number" class="form-control" id="duration_minutes"
                                                    name="duration_minutes" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="calories_burned" class="col-form-label">Kalori terbakar
                                                    (kal):</label>
                                                <input type="number" class="form-control" id="calories_burned"
                                                    name="calories_burned" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="activity_date" class="col-form-label">Tanggal:</label>
                                                <input type="date" class="form-control" id="activity_date"
                                                    name="activity_date" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2" id="searchContent">
            <h3 class="title py-2">Daftar aktivitas fisik </h3>
        </div>
        @forelse ($activities as $activity)
        @empty
            <div class="row">
                <div class="alert alert-info text-center mt-2">
                    <p class="fs-6 fw-semibold text-muted m-0">Belum ada riwayat aktivitas.</p>
                </div>
            </div>
        @endforelse
        <div class="row mt-4" id="searchContent">
            <div class="container p-0">
                <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3">
                    @foreach ($activities as $activity)
                        <div class="col search-item">
                            <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                                <div class="card-body p-2">
                                    <div class="row d-flex align-items-center ps-2">
                                        <div
                                            class="d-flex justify-content-start align-items-center px-0 py-2 mb-3 rounded-3">
                                            <div class="alert alert-success rounded-circle px-3 py-2 border-0 my-0 me-2">
                                                <i class="bi bi-person-arms-up"></i>
                                            </div>
                                            <div class="me-2 d-flex flex-column justify-content-center">
                                                <p class="m-0 fs-6 fw-semibold">{{ $activity->activity_name }}</p>
                                                <p class="m-0 text-secondary-emphasis">{{ $activity->activity_date }}</p>
                                            </div>
                                            <div class="ms-auto d-flex align-items-center me-2">
                                                <button class="btn btn-link text-dark p-0 m-0" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editactivityModal-{{ $activity->id }}">
                                                    <i class="bi bi-pencil-square me-2"></i>
                                                </button>
                                                <form action="{{ route('activities.destroy', $activity->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-link text-dark p-0 m-0" type="submit">
                                                        <i class="bi bi-trash me-2"></i>
                                                    </button>
                                                </form>

                                                {{-- Modal Edit --}}
                                                <div class="modal fade" id="editactivityModal-{{ $activity->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="editactivityModalLabel-{{ $activity->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('activities.update', $activity->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5"
                                                                        id="editactivityModalLabel-{{ $activity->id }}">
                                                                        Perbarui Aktivitas
                                                                        {{ $activity->activity_name }}
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Tutup"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="intensity_level"
                                                                            class="col-form-label text-secondary fs-6 fw-semibold">Intensitas</label>
                                                                        <select class="form-select" id="intensity_level"
                                                                            name="intensity_level" required>
                                                                            <option disabled selected>Pilih
                                                                                Intensitas
                                                                            </option>
                                                                            <option value="Rendah"
                                                                                {{ $activity->intensity_level == 'Rendah' ? 'selected' : '' }}>
                                                                                Rendah
                                                                            </option>
                                                                            <option value="Sedang"
                                                                                {{ $activity->intensity_level == 'Sedang' ? 'selected' : '' }}>
                                                                                Sedang
                                                                            </option>
                                                                            <option value="Tinggi"
                                                                                {{ $activity->intensity_level == 'Tinggi' ? 'selected' : '' }}>
                                                                                Tinggi
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="activity_name"
                                                                            class="col-form-label text-secondary fs-6 fw-semibold">Nama
                                                                            Aktivitas</label>
                                                                        <input type="text" class="form-control"
                                                                            id="activity_name" name="activity_name"
                                                                            value="{{ $activity->activity_name }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="duration_minutes"
                                                                            class="col-form-label text-secondary fs-6 fw-semibold">Durasi
                                                                            (menit)
                                                                        </label>
                                                                        <input type="number" class="form-control"
                                                                            id="duration_minutes" name="duration_minutes"
                                                                            value="{{ $activity->duration_minutes }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="calories_burned"
                                                                            class="col-form-label text-secondary fs-6 fw-semibold">Kalori
                                                                            Terbakar</label>
                                                                        <input type="number" class="form-control"
                                                                            id="calories_burned" name="calories_burned"
                                                                            value="{{ $activity->calories_burned }}"
                                                                            required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="activity_date"
                                                                            class="col-form-label text-secondary fs-6 fw-semibold">Tanggal</label>
                                                                        <input type="date" class="form-control"
                                                                            id="activity_date" name="activity_date"
                                                                            value="{{ $activity->activity_date }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
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
                                    </div>
                                    <div class="row d-flex align-items-center ps-2">
                                        <div class="container">
                                            <div class="row row-cols-3 row-cols-lg-3 g-2 g-lg-3 text-center">
                                                <div class="col">
                                                    <p class="m-0 text-secondary-emphasis">Durasi</p>
                                                    <p class="m-0 fw-semibold">{{ $activity->duration_minutes }} Menit</p>
                                                </div>
                                                <div class="col">
                                                    <p class="m-0 text-secondary-emphasis">Intensitas</p>
                                                    <p class="m-0 fw-semibold">{{ $activity->intensity_level }}</p>
                                                </div>
                                                <div class="col">
                                                    <p class="m-0 text-secondary-emphasis">Kalori</p>
                                                    <p class="m-0 fw-semibold">{{ $activity->calories_burned }} Kkal</p>
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
