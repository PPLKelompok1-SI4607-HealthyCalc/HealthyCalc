@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Supplement Tracker</h2>
        <a href="{{ route('supplements.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">+ Tambah Suplemen</a>
    </div>

    @foreach ($supplements as $supplement)
    <div class="bg-white shadow p-4 rounded mb-4">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-semibold">{{ $supplement->name }}</h3>
                <p class="text-sm text-gray-500">{{ $supplement->dosage }} - {{ $supplement->schedule }}</p>
            </div>
            <form action="{{ route('supplements.destroy', $supplement) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="text-red-500">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
