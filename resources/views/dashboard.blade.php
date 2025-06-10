@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <p class="title py-1 fs-3 fw-bold">Dashboard</p>
        <p class="fs-4 fw-light">Welcome to HealthCalc, {{ auth()->user()->name }}</p>
        <hr>
        {{-- Riwayat Asupan --}}
        <a href="{{ route('intake-histories.index') }}" class="text-decoration-none text-dark">
            <div class="row">
                <div class="row my-1">
                    <p class="fs-5 fw-semibold mt-3 mb-1">Progres Nutrisi Mingguan Riwayat Asupan</p>
                    <p class=" text-secondary fst-italic">
                        Kamu dapat melihat progress nutrisi Kamu selama seminggu terakhir.
                    </p>
                    <canvas id="weeklyChart" class="mx-auto w-25"></canvas>
                </div>
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
                                        <p class="text-secondary fs-6 fw-normal p-0">dari {{ $targetCalories ?? 0 }} kkal
                                        </p>
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
                                                <div class="progress-bar bg-success"
                                                    style="width: {{ $fatProgress ?? 0 }}%">
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
        </a>
        {{-- Riwayat Aktivitas --}}
        <a href="{{ route('activities.index') }}" class="text-decoration-none text-dark">
            <div class="row">
                <p class="fs-5 fw-semibold mt-3 mb-1">Riwayat Aktivitas</p>
                <p class="text-secondary fst-italic">Jangan lupa untuk mencatat riwayat aktivitas kamu, agar kamu dapat
                    melihat
                    progressmu!</p>
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
                                                    <div class="progress-bar bg-success"
                                                        style="width: {{ $minutesProgress }}%">
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
        </a>
        {{-- Pantangan Makanan --}}
        <a href="{{ route('taboo-foods.index') }}" class="text-decoration-none text-dark">
            <div class="row">
                <p class="fs-5 fw-semibold mt-3 mb-1">Pantangan Makanan</p>
                @forelse ($tabooCounts as $taboo => $count)
                    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 m-0">
                        <div class="col ">
                            <div class="py-2 px-3 border border-danger-subtle rounded align-items-center">
                                <div class="d-flex align-items-center gap-2 py-1">
                                    <i class="bi bi-exclamation-triangle text-danger fs-5"></i>
                                    <span class="fw-semibold fs-6 text-danger text-capitalize">{{ $taboo }}</span>
                                </div>
                                <p class="m-0 text-danger">{{ $count }} Makanan</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-secondary fst-italic m-0">Keren kamu tidak ada pantangan makanan</p>
                    <div class="col-12 text-center py-4 alert alert-info text-center mt-2">
                        <p class="fs-6 fw-semibold text-muted m-0">Tidak ada pantangan makanan.</p>
                    </div>
                @endforelse
            </div>
        </a>
        {{-- Rencana Makanan --}}
        <a href="{{ route('food-plannings.index') }}" class="text-decoration-none text-dark">
            <div class="row">
                <p class="fs-5 fw-semibold mt-3 mb-1">Rencana Makanan</p>
                @if ($foodPlannings->count() > 0)
                    <p class="text-secondary fst-italic m-0">Hey {{ auth()->user()->name }}, jangan lupain
                        rencana makanmu ya!</p>
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
                @else
                    <p class="text-secondary fst-italic m-0">Wah pantangan makananmu masih kosong, ayo isi</p>
                    <div class="col-12 text-center py-4 alert alert-info text-center mt-2">
                        <p class="fs-6 fw-semibold text-muted m-0">Tidak ada rencana makanan.</p>
                    </div>
                @endif
            </div>
        </a>
    @endsection