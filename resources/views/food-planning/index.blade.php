@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row mb-3">
                <div class="d-flex justify-content-between">
                    <p class="title py-2 fs-3 fw-bold">Rencana Makanan</p>
                </div>
            </div>
            <div class="row my-2">
                <div class="card w-100 h-100 border-0 shadow-sm mx-2 p-2" style="width: 18rem;">
                    <div class="card-body p-1">
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari Aktivitas"
                                    aria-label="Search" aria-describedby="basic-addon1">
                            </div>
                            <div class="p-0 flex-grow-1 align-self-center">
                                <p class="m-0 py-2 text-center bg-success text-white  rounded-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="bi bi-calendar-plus me-2"></i>+ Buat Rencana
                                    Makanan Baru</p>
                            </div>
                            {{-- Modal Create --}}
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action=" {{ route('food-plannings.store') }}" enctype="multipart/form-data"
                                            method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="community-title">Buat Rencana Makanan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="image" class="col-form-label">Gambar Makanan</label>
                                                    <input type="file" class="form-control" id="image"
                                                        name="image">
                                                </div>
                                                <select class="form-select mb-3" name="food_category" required>
                                                    <option selected>Pilih Kategori</option>
                                                    <option value="Sarapan">Sarapan</option>
                                                    <option value="Makan Siang">Makan Siang</option>
                                                    <option value="Makan Malam">Makan Malam</option>
                                                </select>
                                                <select class="form-select mb-3" name="day" required>
                                                    <option selected>Pilih Hari</option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Minggu">Minggu</option>
                                                </select>
                                                <div class="mb-3">
                                                    <label for="title" class="col-form-label">Nama Makanan:</label>
                                                    <input type="text" class="form-control" id="recipient-name"
                                                        name="title" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="dscription" class="col-form-label">Catatan:</label>
                                                    <textarea class="form-control" id="dscription" name="description" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="planned_time" class="col-form-label">Jam:</label>
                                                    <input type="time" class="form-control" id="planned_time"
                                                        name="planned_time" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Buat</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 ">
                <div class="row mb-2" id="searchContent">
                    <h3 class="title py-2">Daftar Makan Hari ini</h3>
                    {{-- Pertama --}}
                    <div class="row mb-2">
                        @if ($foodPlannings->count() > 0)
                            @foreach ($foodPlannings as $foodPlanning)
                                <div class="col-12 mb-2 search-item">
                                    <a href="{{ route('food-plannings.show', $foodPlanning->id) }}"
                                        class="text-decoration-none text-dark">
                                        <div class="card w-100 border-0 shadow-sm p-2 mb-2"
                                            style="transition: all 0.2s ease-in-out;"
                                            onmouseover="this.classList.remove('shadow-sm'); this.classList.add('shadow');"
                                            onmouseout="this.classList.remove('shadow'); this.classList.add('shadow-sm');">
                                            <div class="card-body p-2">
                                                <div class="row d-flex align-items-center mb-1 ps-2">
                                                    <div class="d-flex justify-content-between px-1">
                                                        @if ($foodPlanning->food_category == 'Sarapan')
                                                            <i class="bi bi-brightness-alt-high-fill text-warning fs-5">
                                                                <span class="m-0 fw-semibold text-black fst-normal">
                                                                    {{ $foodPlanning->food_category }}
                                                                </span>
                                                            </i>
                                                        @elseif ($foodPlanning->food_category == 'Makan Siang')
                                                            <i class="bi bi-brightness-high-fill text-warning fs-5">
                                                                <span class="m-0 fw-semibold text-black fst-normal">
                                                                    {{ $foodPlanning->food_category }}
                                                                </span>
                                                            </i>
                                                        @elseif ($foodPlanning->food_category == 'Makan Malam')
                                                            <i class="bi bi-moon-fill text-info fs-5">
                                                                <span class="m-0 fw-semibold text-black fst-normal">
                                                                    {{ $foodPlanning->food_category }}
                                                                </span>
                                                            </i>
                                                        @endif
                                                        <p>{{ substr($foodPlanning->planned_time, 0, 5) }}</p>
                                                    </div>
                                                </div>
                                                <div class="row d-flex align-items-center mb-1 ps-2">
                                                    <div class="d-flex justify-content-start p-0">
                                                        <div class="mx-2 d-flex align-items-center">
                                                            <img src="{{ asset('img/' . ($foodPlanning->image ?? 'makanan.jpeg')) }}"
                                                                class="img-fluid" style="width: 80px; height: 80px;"
                                                                alt="{{ $foodPlanning->title }}">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="m-0 fs-5 fw-semibold">{{ $foodPlanning->title }}</p>
                                                            <p class="m-0 text-secondary-emphasis">
                                                                {{ $foodPlanning->description }}</p>
                                                        </div>
                                                        <div class="ms-auto me-3 d-flex align-items-center">
                                                            <i class="bi bi-check-circle text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                            <div class="p-0">
                                {{ $foodPlannings->links() }}
                            </div>
                        @else
                            <div class="col-12 text-center py-4 alert alert-info text-center mt-2">
                                <p class="fs-6 fw-semibold text-muted m-0">Belum ada rencana makan hari ini.</p>
                            </div>
                        @endif
                        <div class="p-0">
                            {{ $foodPlannings->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 ">
                <div class="row mb-2">
                    <h3 class="title py-2 px-0">Rekomendasi Menu</h3>
                    <div class="col px-0">
                        <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                            <div class="card-body">
                                @if (count($recommendedFoods) == 0)
                                    <div class="alert alert-info text-center m-0">
                                        <p class="fs-6 fw-semibold text-muted m-0">Tidak ada rekomendasi.</p>
                                    </div>
                                @else
                                    @foreach ($recommendedFoods as $recommendedFood)
                                        <div class="row d-flex align-items-center mb-4 ps-2">
                                            <div class="d-flex justify-content-start p-0">
                                                <div class="mx-2 d-flex align-items-center">
                                                    <img src="{{ asset('img/' . ($recommendedFood->image ?? 'makanan.jpeg')) }}"
                                                        class="img-fluid rounded-full"
                                                        style="width: 40px; height: 40px; border-radius: 50%"
                                                        alt="">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="m-0 fs-5 fw-bold">{{ $recommendedFood->name }}</p>
                                                    <p class="m-0 text-secondary-emphasis">
                                                        {{ $recommendedFood->calories }}
                                                        kalori</p>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
