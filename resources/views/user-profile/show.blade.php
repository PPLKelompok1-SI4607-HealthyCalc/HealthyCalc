@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card w-50 border-0 shadow-sm p-2 mx-auto" style="width: 18rem;">
                <div class="card-body px-2 py-0">
                    <div class="row mb-2 text-center">
                        <p class="fs-4 fw-bold m-0">Ubah Profil</p>
                    </div>
                    <form action="{{ route('user-profiles.update', $userProfile->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($userProfile->photo)
                            <div class="d-flex justify-content-center mb-3">
                                <div
                                    style="width: 120px; height: 120px; border-radius: 50%; background-color: #009879; padding: 4px;">
                                    <img src="{{ asset('img/' . $userProfile->photo) }}" alt="Foto Profil"
                                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 2px solid white;">
                                </div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $userProfile->user->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Usia</label>
                            <input type="number" class="form-control" id="age" name="age"
                                value="{{ $userProfile->age }}">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="" selected hidden>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ $userProfile->gender == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ $userProfile->gender == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="height" class="form-label">Tinggi Badan</label>
                            <input type="number" class="form-control" id="height" name="height"
                                value="{{ $userProfile->height }}">
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Berat Badan</label>
                            <input type="number" class="form-control" id="weight" name="weight"
                                value="{{ $userProfile->weight }}">
                        </div>
                        <div class="mb-3">
                            <label for="activity_level" class="form-label">Tingkat Aktivitas</label>
                            <select class="form-select" id="activity_level" name="activity_level">
                                <option value="" selected hidden>Pilih Tingkat Aktivitas</option>
                                <option value="Sangat Aktif"
                                    {{ $userProfile->activity_level == 'Sangat Aktif' ? 'selected' : '' }}>Sangat Aktif
                                </option>
                                <option value="Cukup Aktif"
                                    {{ $userProfile->activity_level == 'Cukup Aktif' ? 'selected' : '' }}>Cukup Aktif
                                </option>
                                <option value="Kurang Aktif"
                                    {{ $userProfile->activity_level == 'Kurang Aktif' ? 'selected' : '' }}>Kurang Aktif
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>         
    @endsection
