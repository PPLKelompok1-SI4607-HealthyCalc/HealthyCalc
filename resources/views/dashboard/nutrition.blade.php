@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Ringkasan Asupan Gizi Harian</h2>

    <div class="card shadow-sm p-4">
        <canvas id="nutritionChart" height="120"></canvas>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('nutritionChart').getContext('2d');

    const labels = ['Kalori', 'Protein', 'Karbohidrat', 'Lemak'];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Asupan Hari Ini',
            data: [
                {{ $intake->calories ?? 0 }},
                {{ $intake->protein ?? 0 }},
                {{ $intake->carbs ?? 0 }},
                {{ $intake->fat ?? 0 }}
            ],
            backgroundColor: [
                'rgba(0, 137, 89, 0.2)',
                'rgba(0, 123, 255, 0.2)',
                'rgba(255, 193, 7, 0.2)',
                'rgba(220, 53, 69, 0.2)'
            ],
            borderColor: [
                '#008759',
                '#007bff',
                '#ffc107',
                '#dc3545'
            ],
            borderWidth: 2,
            fill: true,
            tension: 0.4,
            pointRadius: 5
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Nutrisi'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Jenis Nutrisi'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };

    new Chart(ctx, config);
</script>
@endsection
