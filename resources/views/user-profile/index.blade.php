@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card w-100 border-0 shadow-sm p-2 mx-auto" style="width: 18rem;">
                <div class="card-body px-2 py-0">
                    <div class="row mb-2">
                        <div class="d-flex justify-content-center mb-3">
                            <div style="width: 120px; height: 120px; border-radius: 50%; background-color: #009879; padding: 4px;">
                                <img src="{{ asset('img/' . ($userProfile->photo ?? 'user_profile.jpeg')) }}" alt="Tidak ada foto" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 2px solid white;" class="d-block mx-auto">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <p class="fs-4 fw-bold">
                                Data Pribadi
                            </p>
                            <div class="col-12 col-lg-6">
                                <div class="name">
                                    <p class="fs-5 fw-semibold mb-0">Nama Lengkap</p>
                                    <p class="mb-1">{{ $userProfile->user->name }}</p>
                                </div>
                                <div class="age">
                                    <p class="fs-5 fw-semibold mb-0">Usia</p>
                                    <p class="mb-1">{{ $userProfile->age ? $userProfile->age . ' tahun' : '- tahun' }}</p>
                                </div>
                                <div class="height">
                                    <p class="fs-5 fw-semibold mb-0">Tinggi Badan</p>
                                    <p class="mb-1">{{ $userProfile->height ? $userProfile->height . ' cm' : '- cm' }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="email">
                                    <p class="fs-5 fw-semibold mb-0">Email</p>
                                    <p class="mb-1">{{ $userProfile->user->email  }}</p>
                                </div>
                                <div class="gender">
                                    <p class="fs-5 fw-semibold mb-0">Jenis Kelamin</p>
                                    <p class="mb-1">{{ $userProfile->gender ? $userProfile->gender : '- ' }}</p>
                                </div>
                                <div class="weight">
                                    <p class="fs-5 fw-semibold mb-0">Berat Badan</p>
                                    <p class="mb-1">{{ $userProfile->weight ? $userProfile->weight . ' kg' : '- kg' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <hr>
                        </div>
                        <div class="row mb-2">
                            <p class="fs-4 fw-bold">
                                Tingkat Aktivitas
                            </p>
                            @if ($userProfile->activity_level)
                                
                            <p class="mb-1">{{ $userProfile->activity_level }}</p>
                            @else
                            <p class="mb-1">Tidak ada tingkat aktivitas</p>
                            @endif
                        </div>
                        <div class="container">
                            <hr>
                        </div>
                        <div class="row mb-2">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('user-profiles.show', $userProfile->id) }}">
                                    <button class="btn btn-primary">
                                        Edit Profil
                                    </button>
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection