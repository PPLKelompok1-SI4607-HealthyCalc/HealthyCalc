@extends('layouts.app')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="{{ route('communities.index') }}" class="text-decoration-none text-success">Komunitas</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $community->title }}</li>
        </ol>
    </nav>
    <div class="row mb-2">
        <div class="card w-100 h-75 border-0 shadow-sm p-2 mb-2" style="width: 18rem;"
            data-category="{{ $community->category }}">
            <div class="card-body p-2 ">
                <div class="row d-flex align-items-center mb-1 ps-2">
                    <div class="d-flex justify-content-start p-0">
                        <div class="mx-2 d-flex align-items-center">
                            <img src="{{ asset('img/' . ($userProfile->photo ?? 'user_profile.jpeg')) }}" class="img-fluid" style="width: 40px; height: 40px;"
                                alt="">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <p class="m-0">{{ $community->user->name }}</p>
                            <p class="m-0">Dibuat {{ $community->created_at->diffForHumans() }}</p>
                        </div>
                        @if (auth()->check() && auth()->user()->id === $community->user_id)
                        <div class="ms-auto">
                            <button type="button" class="btn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action=" {{ route('communities.update', $community->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="community-title">Perbarui Postingan {{ $community->title }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <select class="form-select mb-3" name="category" required>
                                                    <option selected>Pilih Kategori</option>
                                                    <option value="Umum">Umum</option>
                                                    <option value="Diet">Diet</option>
                                                    <option value="Olahraga">Olahraga</option>
                                                    <option value="Kesehatan">Kesehatan</option>
                                                </select>
                                                <div class="mb-3">
                                                    <label for="title" class="col-form-label">Judul:</label>
                                                    <input type="text" class="form-control" id="recipient-name"
                                                        name="title" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="dscription" class="col-form-label">Message:</label>
                                                    <textarea class="form-control" id="dscription" name="description" required></textarea>
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
                        <div class="mx-2">
                            <form action="{{ route('communities.destroy', $community->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn ">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <p class="fs-4 fw-bold mb-1">
                        {{ $community->title }}
                    </p>
                    <p class="fs-5 mb-1">
                        {{ $community->description }}
                    </p>
                </div>
                <div class="row">
                    <div class="d-flex">
                        <div class="p-2 flex-grow-1 px-0">
                            <div class="col">
                                <span
                                    class="badge rounded-pill shadow-sm text-bg-success">{{ $community->category }}</span>
                            </div>
                        </div>
                        <div class="p-2">
                            <i class="bi bi-chat"></i>
                            12
                        </div>
                        <div class="p-2">
                            <i class="bi bi-heart"></i>
                            {{ $community->like }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
