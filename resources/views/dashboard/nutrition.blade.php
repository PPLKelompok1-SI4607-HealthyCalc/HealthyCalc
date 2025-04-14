@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Ringkasan Asupan Gizi Harian</h2>

    {{-- Dummy data dari Controller --}}
    @php
        $nutrition = [
            'kalori' => ['consumed' => 1400, 'target' => 2000],
            'protein' => ['consumed' => 60, 'target' => 75],
            'karbo'   => ['consumed' => 180, 'target' => 250],
            'lemak'   => ['consumed' => 50, 'target' => 70],
        ];
    @endphp

    <div class="row">
        @foreach ($nutrition as $key => $value)
            @php
                $percentage = $value['target'] > 0 
                    ? ($value['consumed'] / $value['target']) * 100 
                    : 0;
            @endphp

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body text-center">
                        <h5 class="card-title text-capitalize">{{ $key }}</h5>
                        <p class="fs-4 mb-1">{{ $value['consumed'] }} / {{ $value['target'] }}</p>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ $percentage }}%"
                                 aria-valuenow="{{ $value['consumed'] }}"
                                 aria-valuemin="0"
                                 aria-valuemax="{{ $value['target'] }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
