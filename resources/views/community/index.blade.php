@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <p class="title py-2 fs-3 fw-bold">Komunitas</p>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8 ">
                {{-- trending --}}
                <div class="row mb-2">
                    <h3 class="title py-2 px-0 fs-3 fw-semibold">Sedang Trending</h3>
                    @forelse ($communities_trending as $community_trending)
                        <div class="col-12 col-md-6 ps-0">
                            <a href="{{ route('communities.show', $community_trending->id) }}"
                                class="text-decoration-none text-dark">
                                <div class="card w-100 border-0 shadow-sm p-2 my-2 px-0"
                                    style="transition: all 0.2s ease-in-out;"
                                    onmouseover="this.classList.remove('shadow-sm'); this.classList.add('shadow');"
                                    onmouseout="this.classList.remove('shadow'); this.classList.add('shadow-sm');">
                                    <div class="card-body p-2">
                                        <div class="row d-flex align-items-center mb-1 ps-2">
                                            <div class="d-flex justify-content-start p-0">
                                                <div class="mx-2 d-flex align-items-center">
                                                    <img src="{{ asset('img/' . ($userProfile->photo ?? 'user_profile.jpeg')) }}"
                                                        class="img-fluid" style="width: 40px; height: 40px;" alt="">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-2">
                                                    <p class="m-0 fs-5 fw-bold">{{ $community_trending->title }}</p>
                                                    <p class="m-0">oleh {{ $community_trending->user->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-start">
                                                <p class="mx-2 my-0">
                                                    <img src="img/comment.svg" class="img-fluid" alt="">
                                                    12
                                                </p>
                                                <p class="mx-2 fs-6 my-0">
                                                    <img src="img/like.svg" class="img-fluid" alt="">
                                                    {{ $community_trending->like }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada postingan trending.</p>
                    @endforelse
                </div>

                {{-- Search --}}
                <div class="row mt-2">
                    <div class="card w-100 h-100 border-0 shadow-sm p-2">
                        <div class="card-body p-1">
                            <div class="d-flex">
                                <div class="p-2 flex-grow-1">
                                    <input type="text" class="form-control" id="searchInput"
                                        placeholder="Cari Aktivitas" aria-label="Search">
                                </div>
                                <div class="p-0 flex-grow-1 align-self-center">
                                    <p class="m-0 py-2 text-center bg-success text-white rounded-3"
                                       data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"
                                       dusk="create-post-button">Buat Postingan Baru</p>
                                </div>

                                {{-- Modal Create --}}
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('communities.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="community-title">Buat Postingan Baru</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <select class="form-select mb-3" name="category" required>
                                                        <option selected disabled>Pilih Kategori</option>
                                                        <option value="Umum">Umum</option>
                                                        <option value="Diet">Diet</option>
                                                        <option value="Olahraga">Olahraga</option>
                                                        <option value="Kesehatan">Kesehatan</option>
                                                    </select>
                                                    <div class="mb-3">
                                                        <label for="title" class="col-form-label">Judul:</label>
                                                        <input type="text" class="form-control" name="title" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description" class="col-form-label">Message:</label>
                                                        <textarea class="form-control" name="description" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Posting</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- buat diskusi terbaru --}}
                <div class="row mb-2">
                    <h3 class="title px-0 py-2 fs-3 fw-semibold">Diskusi Terbaru</h3>
                </div>
                <div class="row mb-2" id="searchContent">
                    @forelse ($communities as $community)
                        <div class="mb-3 p-0 search-item">
                            <a href="{{ route('communities.show', $community->id) }}"
                                class="text-decoration-none text-dark">
                                <div class="card w-100 h-100 border-0 shadow-sm p-2"
                                    style="transition: all 0.2s ease-in-out;"
                                    onmouseover="this.classList.remove('shadow-sm'); this.classList.add('shadow');"
                                    onmouseout="this.classList.remove('shadow'); this.classList.add('shadow-sm');">
                                    <div class="card-body p-2">
                                        <div class="row d-flex align-items-center mb-1 ps-2">
                                            <div class="d-flex justify-content-start p-0">
                                                <div class="mx-2 d-flex align-items-center">
                                                    <img src="{{ asset('img/' . ($userProfile->photo ?? 'user_profile.jpeg')) }}"
                                                        class="img-fluid" style="width: 40px; height: 40px;"
                                                        alt="">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="m-0">{{ $community->user->name }}</p>
                                                    <p class="m-0">Dibuat {{ $community->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
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
                                                    <img src="img/comment.svg" class="img-fluid" alt="">
                                                    12
                                                </div>
                                                <div class="p-2">
                                                    <img src="img/like.svg" class="img-fluid" alt="">
                                                    {{ $community->like }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">Tidak ada diskusi terbaru.</p>
                    @endforelse
                    <div class="p-0">
                        {{ $communities->links() }}
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 ">
                <div class="row mb-2">
                    <h3 class="title py-2 fs-3 fw-semibold">Anggota Aktif</h3>
                    <div class="col">
                        <div class="card w-100 h-100 border-0 shadow-sm p-2">
                            <div class="card-body px-2 py-0">
                                @forelse ($users as $user)
                                    <div class="row mb-2 d-flex align-items-center">
                                        <div class="col-12 col-md-2 d-flex justify-content-center">
                                            <img src="{{ asset('img/' . ($userProfile->photo ?? 'user_profile.jpeg')) }}"
                                                class="img-fluid" style="width: 40px; height: 40px;" alt="">
                                        </div>
                                        <div class="col-12 col-md-10">
                                            <p class="m-0 fw-bold">{{ $user->name }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">Belum ada anggota aktif.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- pengumuman komunitas --}}
                <div class="row mb-2">
                    <h3 class="title py-2 fs-3 fw-semibold">Pengumuman Komunitas</h3>
                    <div class="col">
                        <div class="card w-100 h-100 border-0 shadow-sm p-2">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <span class="border-start border-5 border-success ps-3">
                                        <p class="fs-5 fw-bold">Webinar: Nutrisi untuk Imunitas</p>
                                        <p class="text-secondary">Sabtu, 15 Maret 2025</p>
                                    </span>
                                </div>
                                <div class="row mb-3">
                                    <span class="border-start border-5 border-success ps-3">
                                        <p class="fs-5 fw-bold">Challenge: 30 Hari Hidup Sehat</p>
                                        <p class="text-secondary">Mulai 1 April 2025</p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- tips kesehatan --}}
                <div class="row mb-2">
                    <h3 class="title py-2 fs-3 fw-semibold">Tips Kesehatan</h3>
                    <div class="col">
                        <div class="card w-100 h-100 border-0 shadow-sm p-2">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="d-flex justify-content-start p-0">
                                        <div class="d-flex align-items-center">
                                            <img src="img/apple.svg" class="img-fluid pe-2" style="max-width: 40px;" alt="">
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="m-0">Konsumsi minimal 5 porsi buah dan sayur setiap hari</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="d-flex justify-content-start p-0">
                                        <div class="d-flex align-items-center">
                                            <img src="img/water.svg" class="img-fluid pe-2" style="max-width: 40px;" alt="">
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="m-0">Minum 8 gelas air putih setiap hari</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="d-flex justify-content-start p-0">
                                        <div class="d-flex align-items-center">
                                            <img src="img/moon.svg" class="img-fluid pe-2" style="max-width: 40px;" alt="">
                                            <div class="d-flex flex-column justify-content-center">
                                                <p class="m-0">Tidur 7-8 jam setiap malam</p>
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
    </div>
@endsection
