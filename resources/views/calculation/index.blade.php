@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card w-100 border-0 shadow-sm p-2 mx-auto" style="width: 18rem;">
                <div class="card-body px-2 py-0">
                    <div class="row mb-2">
                        <p class="title py-2 fs-3 fw-bold">Hitung Kalori</p>
                    </div>
                    <div class="row mb-2">
                        <form action="{{ route('calculations.store') }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <label for="age" class="form-label">Usia</label>
                                <input type="number" class="form-control" id="age" name="age"
                                    value="{{ old('age') ?? $userProfile->age }}">
                            </div>
                            <div class="mb-2">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="" selected hidden>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ $userProfile->gender == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="Perempuan" {{ $userProfile->gender == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="height" class="form-label">Tinggi Badan</label>
                                <input type="number" class="form-control" id="height" name="height"
                                    value="{{ old('height') ?? $userProfile->height }}">
                            </div>
                            <div class="mb-2">
                                <label for="weight" class="form-label">Berat Badan</label>
                                <input type="number" class="form-control" id="weight" name="weight"
                                    value="{{ old('weight') ?? $userProfile->weight }}">
                            </div>
                            <div class="mb-2">
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
                            <div class="mb-2">
                                <button type="submit" class="btn btn-primary">Hitung</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
