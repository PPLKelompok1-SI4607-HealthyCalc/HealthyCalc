@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Perhitungan Kalori</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="font-weight-bold">Kalori yang dibutuhkan per hari:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-primary">{{ $calories }} kkal</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="font-weight-bold">Protein yang dibutuhkan per hari:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-primary">{{ $protein }} gram</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="font-weight-bold">Karbohidrat yang dibutuhkan per hari:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-primary">{{ $carbs }} gram</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="font-weight-bold">Lemak yang dibutuhkan per hari:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-primary">{{ $fat }} gram</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
