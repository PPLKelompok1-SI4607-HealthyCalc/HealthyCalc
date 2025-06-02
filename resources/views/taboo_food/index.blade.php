@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
            <p class="title py-2 fs-3 fw-bold">Makanan Pantangan</p>
        </div>
        <div class="row mb-2">
            <div class="d-flex">
                <div class="p-2 flex-grow-1">
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari Makanan Pantangan">
                </div>
                <div class="p-0 flex-grow-1 align-self-center">
                    <p class="m-0 py-2 text-center bg-success text-white rounded-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">+ Tambah Makanan Pantangan</p>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('taboo-foods.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="community-title">Buat Makanan Pantangan Baru</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="taboo" class="col-form-label">Kategori Pantangan:</label>
                                        <select class="form-select" id="taboo" name="taboo" required>
                                            <option value="" selected hidden>Pilih</option>
                                            <option value="alergi">Alergi</option>
                                            <option value="kolesterol">Kolesterol</option>
                                            <option value="diabetes">Diabetes</option>
                                            <option value="diet">Diet</option>
                                            <option value="gula">Gula</option>
                                            <option value="garam">Garam</option>
                                            <option value="lemak">Lemak</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="food_name" class="col-form-label">Nama Makanan:</label>
                                        <input type="text" class="form-control" id="food_name" name="food_name" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 mb-4">
                    @foreach ($tabooCounts as $taboo => $count)
                        <div class="col">
                            <div class="py-2 px-3 border border-danger-subtle rounded align-items-center">
                                <div class="d-flex align-items-center gap-2 py-1">
                                    <i class="bi bi-exclamation-triangle text-danger fs-5"></i>
                                    <span class="fw-semibold fs-6 text-danger text-capitalize">{{ $taboo }}</span>
                                </div>
                                <p class="m-0 text-danger">{{ $count }} Makanan</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row mb-2">
                    <h3 class="title pt-2">Daftar Makanan Pantangan</h3>
                </div>

                @forelse ($tabooFoods as $tabooFood)
                @empty
                    <div class="row">
                        <div class="alert alert-info text-center mt-2">
                            <p class="fs-6 fw-semibold text-muted m-0">Belum ada daftar makanan pantangan.</p>
                        </div>
                    </div>
                @endforelse

                <div class="row mb-2" id="searchContent">
                    <div class="container-fluid">
                        @foreach ($tabooFoods as $tabooFood)
                            <div class="col-12 mb-2 search-item" data-food-name="{{ strtolower($tabooFood->food_name) }}"
                                data-taboo="{{ strtolower($tabooFood->taboo) }}">
                                <hr>
                                <div class="d-flex justify-content-start align-items-center p-0">
                                    <div class="p-2 fs-3 text-danger">
                                        <i class="bi bi-dot"></i>
                                    </div>
                                    <div class="p-2 fw-semibold">{{ $tabooFood->food_name }}</div>
                                    <div class="p-2">
                                        <p class="m-0 py-1 px-2 bg-danger text-white rounded-2">
                                            {{ $tabooFood->taboo }}
                                        </p>
                                    </div>
                                    <div class="ms-auto d-flex gap-1">
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editTabooFoodModal-{{ $tabooFood->id }}">
                                            Edit
                                        </button>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editTabooFoodModal-{{ $tabooFood->id }}" tabindex="-1"
                                            aria-labelledby="editTabooFoodModalLabel-{{ $tabooFood->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('taboo-foods.update', $tabooFood->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="editTabooFoodModalLabel-{{ $tabooFood->id }}">
                                                                Perbarui Makanan Pantangan {{ $tabooFood->food_name }}
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="taboo" class="col-form-label">Kategori Pantangan:</label>
                                                                <select class="form-select" name="taboo" required>
                                                                    <option disabled selected>Pilih Kategori</option>
                                                                    <option value="alergi" {{ $tabooFood->taboo == 'alergi' ? 'selected' : '' }}>Alergi</option>
                                                                    <option value="kolesterol" {{ $tabooFood->taboo == 'kolesterol' ? 'selected' : '' }}>Kolesterol</option>
                                                                    <option value="diabetes" {{ $tabooFood->taboo == 'diabetes' ? 'selected' : '' }}>Diabetes</option>
                                                                    <option value="diet" {{ $tabooFood->taboo == 'diet' ? 'selected' : '' }}>Diet</option>
                                                                    <option value="gula" {{ $tabooFood->taboo == 'gula' ? 'selected' : '' }}>Gula</option>
                                                                    <option value="garam" {{ $tabooFood->taboo == 'garam' ? 'selected' : '' }}>Garam</option>
                                                                    <option value="lemak" {{ $tabooFood->taboo == 'lemak' ? 'selected' : '' }}>Lemak</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="food_name" class="col-form-label">Nama Makanan:</label>
                                                                <input type="text" class="form-control" name="food_name" required
                                                                    value="{{ $tabooFood->food_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tombol Delete -->
                                        <form action="{{ route('taboo-foods.destroy', $tabooFood->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus makanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
