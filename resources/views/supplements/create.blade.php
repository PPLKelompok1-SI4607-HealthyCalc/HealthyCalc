@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Tambah Suplemen</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('supplements.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-medium mb-1">Nama Suplemen</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="dosage" class="block font-medium mb-1">Dosis</label>
            <input type="text" name="dosage" id="dosage" class="w-full border rounded px-3 py-2" placeholder="Contoh: 2000 IU" required>
        </div>

        <div class="mb-4">
            <label for="schedule" class="block font-medium mb-1">Jadwal Konsumsi</label>
            <input type="text" name="schedule" id="schedule" class="w-full border rounded px-3 py-2" placeholder="Contoh: 08:00, 20:00" required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('supplements.index') }}" class="mr-4 text-gray-500 hover:underline">Batal</a>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        </div>
    </form>
</div>
@endsection
