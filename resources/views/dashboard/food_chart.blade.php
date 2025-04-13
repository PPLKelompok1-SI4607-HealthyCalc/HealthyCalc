@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Grafik Konsumsi Kalori Mingguan</h2>

    <div class="card shadow-sm p-4">
        <canvas id="calorieChart" height="120"></canvas>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('calorieChart').getContext('2d');

    const labels = {!! json_encode($data->pluck('date')) !!};
    const data = {
        labels: labels,
        datasets: [{
            label: 'Total Kalori',
            data: {!! json_encode($data->pluck('total_calories')) !!},
            backgroundColor: 'rgba(0, 137, 89, 0.2)',
            borderColor: '#008759',
            borderWidth: 2,
            fill: true,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: '#008759'
        }]
    };

    const config = {
        type: 'line', // Ganti jadi 'bar' kalau mau bar chart
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Kalori (kcal)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
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
