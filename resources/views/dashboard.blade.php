@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="row">
                <p class="title py-2 fs-3 fw-bold">Dashboard</p>
            </div>
        </div>
        {{-- Riwayat Aktivitas --}}
        <div class="row my-2">
            <p class="fs-5 fw-semibold">Riwayat Aktivitas</p>
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
                                            <p class="fs-4 fw-bold m-0">{{ $weeklyCaloriesi }} Kkal</p>
                                            <div class="alert alert-success rounded-circle px-3 py-2 border-0">
                                                <i class="bi bi-fire text-success"></i>
                                            </div>
                                        </div>
                                        <div class="container p-0">
                                            <div class="progress" role="progressbar" aria-label="Success example"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success"
                                                    style="width: {{ $caloriesProgressi }}%"></div>
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
                                            <p class="fs-4 fw-bold m-0">{{ $weeklyMinutes }} Menit</p>
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
        {{-- Riwayat Asupan --}}
        <div class="row my-2">
            <div class="row my-4">
                <h4 class="text-center">Progress Nutrisi Mingguan</h4>
                <canvas id="weeklyChart" class="mx-auto w-25"></canvas>
            </div>
            <p class="fs-5 fw-semibold mt-2">Riwayat Asupan</p>
            <div class="container p-0">
                <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-4">
                    {{-- Total Kalori Terbakar --}}
                    <div class="col">
                        <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                            <div class="card-body">
                                <div class="row d-flex align-items-center ps-2">
                                    <p class="fs-6 fw-semibold text-secondary p-0 m-0">Total Kalori Terbakar</p>
                                    <div
                                        class="d-flex justify-content-between align-items-center p-0 mb-0 bg-tertiary rounded-3">
                                        <p class="fs-4 fw-bold m-0">{{ $weeklyCalories ?? 0 }}</p>
                                        <div class="alert alert-success rounded-circle px-3 py-2 border-0">
                                            <i class="bi bi-fire text-success"></i>
                                        </div>
                                    </div>
                                    <p class="text-secondary fs-6 fw-normal p-0">dari {{ $targetCalories ?? 0 }} kkal</p>
                                    <div class="container p-0">
                                        <div class="progress" role="progressbar" aria-label="Success example"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success"
                                                style="width: {{ $caloriesProgress ?? 0 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Protein --}}
                    <div class="col">
                        <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                            <div class="card-body">
                                <div class="row d-flex align-items-center ps-2">
                                    <p class="fs-6 fw-semibold text-secondary p-0 m-0">Total Protein</p>
                                    <div
                                        class="d-flex justify-content-between align-items-center p-0 mb-0 bg-tertiary rounded-3">
                                        <p class="fs-4 fw-bold m-0">{{ $weeklyProtein ?? 0 }}</p>
                                        <div class="alert alert-success rounded-circle py-2 px-3 border-0 ">
                                            <i class="bi bi-clock text-success"></i>
                                        </div>
                                    </div>
                                    <p class="text-secondary fs-6 fw-normal p-0">dari {{ $targetProtein ?? 0 }} g</p>
                                    <div class="container p-0">
                                        <div class="progress" role="progressbar" aria-label="Success example"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success"
                                                style="width: {{ $proteinProgress ?? 0 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Karbohidrat --}}
                    <div class="col">
                        <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                            <div class="card-body">
                                <div class="row d-flex align-items-center ps-2">
                                    <p class="fs-6 fw-semibold text-secondary p-0 m-0">Total Karbohidrat</p>
                                    <div
                                        class="d-flex justify-content-between align-items-center p-0 mb-0 bg-tertiary rounded-3">
                                        <p class="fs-4 fw-bold m-0">{{ $weeklyCarbs ?? 0 }}</p>
                                        <div class="alert alert-success rounded-circle px-3 py-2 border-0">
                                            <i class="bi bi-person-arms-up text-success"></i>
                                        </div>
                                    </div>
                                    <p class="text-secondary fs-6 fw-normal p-0">dari {{ $targetCarbs ?? 0 }} g</p>
                                    <div class="container p-0">
                                        <div class="progress" role="progressbar" aria-label="Success example"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success"
                                                style="width: {{ $carbsProgress ?? 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Lemak --}}
                    <div class="col">
                        <div class="card w-100 h-100 border-0 shadow-sm p-2" style="width: 18rem;">
                            <div class="card-body">
                                <div class="row d-flex align-items-center ps-2">
                                    <p class="fs-6 fw-semibold text-secondary p-0 m-0">Total Lemak</p>
                                    <div
                                        class="d-flex justify-content-between align-items-center p-0 mb-0 bg-tertiary rounded-3">
                                        <p class="fs-4 fw-bold m-0">{{ $weeklyFat ?? 0 }}</p>
                                        <div class="alert alert-success rounded-circle px-3 py-2 border-0">
                                            <i class="bi bi-person-arms-up text-success"></i>
                                        </div>
                                    </div>
                                    <p class="text-secondary fs-6 fw-normal p-0">dari {{ $targetFat ?? 0 }} g</p>
                                    <div class="container p-0">
                                        <div class="progress" role="progressbar" aria-label="Success example"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success" style="width: {{ $fatProgress ?? 0 }}%">
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
