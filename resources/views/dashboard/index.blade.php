@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Calories</h5>
                    <p>{{ $summary->total_calories }} kcal</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Protein</h5>
                    <p>{{ $summary->total_protein }} g</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Carbs</h5>
                    <p>{{ $summary->total_carbs }} g</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Fat</h5>
                    <p>{{ $summary->total_fat }} g</p>
                </div>
            </div>
        </div>
    </div>

    <h3>Recent Food Logs</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Food Name</th>
                <th>Portion</th>
                <th>Calories</th>
                <th>Protein</th>
                <th>Carbs</th>
                <th>Fat</th>
                <th>Consumed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foodLogs as $log)
                <tr>
                    <td>{{ $log->food_name }}</td>
                    <td>{{ $log->portion }}</td>
                    <td>{{ $log->calories }}</td>
                    <td>{{ $log->protein }}</td>
                    <td>{{ $log->carbs }}</td>
                    <td>{{ $log->fat }}</td>
                    <td>{{ $log->consumed_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection