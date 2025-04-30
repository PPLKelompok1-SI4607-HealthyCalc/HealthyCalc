<!-- filepath: f:\GitHub\HealthyCalc\resources\views\analysis.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Dashboard Analysis Pengembangan</h1>

    <!-- Perkembangan Berat Badan -->
    <h2>Perkembangan Berat Badan</h2>
    @if ($weightProgress->isEmpty())
        <p>Belum ada data berat badan.</p>
    @else
        <ul>
            @foreach ($weightProgress as $progress)
                <li>{{ $progress->date }}: {{ $progress->weight }} kg</li>
            @endforeach
        </ul>
    @endif

    <!-- Asupan Kalori -->
    <h2>Asupan Kalori</h2>
    @if ($calorieIntake->isEmpty())
        <p>Belum ada data asupan kalori.</p>
    @else
        <ul>
            @foreach ($calorieIntake as $calorie)
                <li>{{ $calorie->date }}: {{ $calorie->total_calories }} kalori</li>
            @endforeach
        </ul>
    @endif

    <!-- Aktivitas Fisik -->
    <h2>Aktivitas Fisik</h2>
    @if ($physicalActivity->isEmpty())
        <p>Belum ada data aktivitas fisik.</p>
    @else
        <ul>
            @foreach ($physicalActivity as $activity)
                <li>{{ $activity->date }}: {{ $activity->activity }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Form Perbarui Data -->
    <h2>Perbarui Data</h2>
    <form action="{{ route('dashboard.analysis.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="weight" class="form-label">Berat Badan (kg):</label>
            <input type="number" name="weight" id="weight" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="calories" class="form-label">Asupan Kalori:</label>
            <input type="number" name="calories" id="calories" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="activity" class="form-label">Aktivitas Fisik:</label>
            <input type="text" name="activity" id="activity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection