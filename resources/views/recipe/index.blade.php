@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row mb-3">
                <div class="d-flex justify-content-between">
                    <p class="title py-2 fs-3 fw-bold">Resep Makanan</p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="card w-100 h-5 7-0 shadow-sm mx-2 p-2" style="width: 18rem;">
                    <div class="card-body p-1">
                        <div class="d-flex">
                            <div class="p-2 flex-grow-1">
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari Resep Makanan"
                                    aria-label="Search" aria-describedby="basic-addon1">
                            </div>
                            <div class="p-0 flex-grow-1 align-self-center">
                                <p class="m-0 py-2 text-center bg-success text-white  rounded-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="bi bi-calendar-plus me-2"></i>+ Buat Resep
                                    Makanan Baru</p>
                            </div>
                            {{-- Modal Create --}}
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action=" {{ route('recipes.store') }} " method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="community-title">Buat Resep Makanan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="name" class="col-form-label">Nama Resep</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="calories" class="col-form-label">Kalori
                                                                (Kkal)</label>
                                                            <input type="number" class="form-control" id="calories"
                                                                name="calories" step="0.01">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="protein" class="col-form-label">Protein (g)</label>
                                                            <input type="number" class="form-control" id="protein"
                                                                name="protein" step="0.01">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="time" class="col-form-label">Waktu Memasak (mis:
                                                                25 min)</label>
                                                            <input type="number" class="form-control" id="time"
                                                                name="time">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="carb" class="col-form-label">Karbohidrat
                                                                (g)</label>
                                                            <input type="number" class="form-control" id="carb"
                                                                name="carb" step="0.01">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="fat" class="col-form-label">Lemak (g)</label>
                                                            <input type="number" class="form-control" id="fat"
                                                                name="fat" step="0.01">
                                                        </div>
                                                        <label for="nutrition_type" class="col-form-label">Tag
                                                            nutrisi:</label>
                                                        <select class="form-select mb-3" id="nutrition_type"
                                                            name="nutrition_type" required>
                                                            <option selected>Pilih Kategori</option>
                                                            <option value="Diet">Diet</option>
                                                            <option value="Tinggi Protein">Tinggi Protein</option>
                                                            <option value="Rendah Kalori">Rendah Kalori</option>
                                                            <option value="Vegetarian">Vegetarian</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ingridients" class="col-form-label">Bahan-bahan</label>
                                                    <textarea class="form-control" id="ingridients" name="ingridients" rows="3"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="steps" class="col-form-label">Instruksi memasak</label>
                                                    <textarea class="form-control" id="steps" name="steps" rows="3"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="col-form-label">Gambar resep</label>
                                                    <input type="file" class="form-control" id="image"
                                                        name="image">
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

            <div class="row mt-2" id="searchContent">
                <h3 class="title py-2">Daftar resep makanan </h3>
                <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-2">
                    @forelse ($recipes as $recipe)
                        <div class="col search-item">
                            <div class="card mb-3 "
                                onmouseover="this.classList.remove('shadow-sm'); this.classList.add('shadow');"
                                onmouseout="this.classList.remove('shadow'); this.classList.add('shadow-sm');">
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="text-decoration-none text-dark">
                                    <img src="{{ asset('img/' . ($recipe->image ?? 'makanan.jpeg')) }}"
                                        class="card-img-top" alt="Gambar resep"
                                        style="max-height: 200px; object-fit: cover;">

                                    <div class="card-body">
                                        <p class="badge text-bg-success">{{ $recipe->nutrition_type }}</p>
                                        <h5 class="card-title">{{ $recipe->name }}</h5>
                                        <div class="row">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-fire text-danger fs-6"></i>
                                                    <span class="fw-normal text-dark">{{ $recipe->calories }} kal</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="bi bi-clock-fill text-secondary fs-6"></i>
                                                    <span class="fw-normal text-dark">{{ $recipe->time }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="d-flex justify-content-end p-3 pt-1">
                                    <button class="btn btn-link text-dark p-0 m-0" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editrecipeModal-{{ $recipe->id }}">
                                        <i class="bi bi-pencil-fill text-primary"></i>
                                    </button>
                                    <div class="m-0">
                                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link text-dark p-0 m-0" type="submit">
                                                <i class="bi bi-trash-fill ms-2 text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editrecipeModal-{{ $recipe->id }}" tabindex="-1"
                                    aria-labelledby="editrecipeModalLabel-{{ $recipe->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('recipes.update', $recipe->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5"
                                                        id="editrecipeModalLabel-{{ $recipe->id }}">
                                                        Perbarui Resep
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name" class="col-form-label">Nama
                                                            Resep:</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" value="{{ $recipe->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="calories" class="col-form-label">Kalori
                                                            (Kkal)
                                                            :</label>
                                                        <input type="number" class="form-control" id="calories"
                                                            name="calories" value="{{ $recipe->calories }}"
                                                            step="0.01" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="protein" class="col-form-label">Protein
                                                            (g):</label>
                                                        <input type="number" class="form-control" id="protein"
                                                            name="protein" value="{{ $recipe->protein }}" step="0.01"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="carb" class="col-form-label">Karbohidrat
                                                            (g):</label>
                                                        <input type="number" class="form-control" id="carb"
                                                            name="carb" value="{{ $recipe->carb }}" step="0.01"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="fat" class="col-form-label">Lemak
                                                            (g):</label>
                                                        <input type="number" class="form-control" id="fat"
                                                            name="fat" value="{{ $recipe->fat }}" step="0.01"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nutrition_type" class="col-form-label">Tag
                                                            nutrisi:</label>
                                                        <select class="form-select" id="nutrition_type"
                                                            name="nutrition_type">
                                                            <option value="Diet"
                                                                {{ $recipe->nutrition_type == 'Diet' ? 'selected' : '' }}>
                                                                Diet
                                                            </option>
                                                            <option value="Tinggi Protein"
                                                                {{ $recipe->nutrition_type == 'Tinggi Protein' ? 'selected' : '' }}>
                                                                Tinggi Protein</option>
                                                            <option value="Rendah Kalori"
                                                                {{ $recipe->nutrition_type == 'Rendah Kalori' ? 'selected' : '' }}>
                                                                Rendah Kalori</option>
                                                            <option value="Vegetarian"
                                                                {{ $recipe->nutrition_type == 'Vegetarian' ? 'selected' : '' }}>
                                                                Vegetarian</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="time" class="col-form-label">Waktu Memasak
                                                            (menit)
                                                            :</label>
                                                        <input type="number" class="form-control" id="time"
                                                            name="time" value="{{ $recipe->time }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="ingridients"
                                                            class="col-form-label">Bahan-bahan:</label>
                                                        <textarea class="form-control" id="ingridients" name="ingridients" required>{{ $recipe->ingridients }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="steps"
                                                            class="col-form-label">Langkah-langkah:</label>
                                                        <textarea class="form-control" id="steps" name="steps" required>{{ $recipe->steps }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image" class="col-form-label">Gambar:</label>
                                                        <input type="file" class="form-control" id="image"
                                                            name="image">
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
                    @empty
                        <div class="alert alert-info text-center mt-2">
                            <p class="fs-6 fw-semibold text-muted m-0">Belum ada resep makanan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection