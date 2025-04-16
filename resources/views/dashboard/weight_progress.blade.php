@extends('layouts.app') 

@section('content') 
<div class="container py-5"> 
    <h2 class="text-center mb-4 fw-bold">Progress Berat Badan</h2> 
 
    <div class="card shadow-sm p-4"> 
        <canvas id="weightChart" height="120"></canvas> 
    </div> 
</div> 
 
<!-- Chart.js CDN --> 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
 
<script> 
    const ctx = document.getElementById('weightChart').getContext('2d'); 
 
    const labels = {!! json_encode($weights->pluck('date')) !!}; 
    const data = { 
        labels: labels, 
        datasets: [{ 
            label: 'Berat Badan (kg)', 
            data: {!! json_encode($weights->pluck('weight')) !!}, 
            borderColor: '#008759', 
            backgroundColor: 'rgba(0, 137, 89, 0.2)', 
            fill: true, 
            tension: 0.4, 
            pointRadius: 5, 
            pointBackgroundColor: '#008759' 
        }] 
    }; 
 
    const config = { 
        type: 'line', 
        data: data, 
        options: { 
            responsive: true, 
            scales: { 
                y: { 
                    beginAtZero: false, 
                    title: { 
                        display: true, 
                        text: 'Berat (kg)' 
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
                }, 
                tooltip: { 
                    mode: 'index', 
                    intersect: false 
                } 
            } 
        } 
    }; 
 
    new Chart(ctx, config); 
</script> 
@endsection