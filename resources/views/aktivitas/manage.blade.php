@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-md">
    <h1 class="text-2xl font-bold mb-4">{{ $activity ? 'Edit' : 'Tambah' }} Aktivitas</h1>
    
    <form method="POST" action="/aktivitas/manage{{ $activity ? '/'.$activity->id : '' }}">
        @csrf
        @if($activity) @method('PUT') @endif

        <div class="mb-4">
            <label class="block mb-1">Nama Aktivitas</label>
            <input type="text" name="nama" value="{{ $activity->nama ?? old('nama') }}" 
                   class="w-full p-2 border rounded" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-1">Intensitas</label>
                <select name="intensitas" class="w-full p-2 border rounded" required>
                    <option value="Ringan" {{ ($activity->intensitas ?? old('intensitas')) == 'Ringan' ? 'selected' : '' }}>Ringan</option>
                    <option value="Sedang" {{ ($activity->intensitas ?? old('intensitas')) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Tinggi" {{ ($activity->intensitas ?? old('intensitas')) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>
            <div>
                <label class="block mb-1">Durasi (menit)</label>
                <input type="number" name="durasi" value="{{ $activity->durasi ?? old('durasi') }}" 
                       class="w-full p-2 border rounded" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-1">Kalori (kkal)</label>
                <input type="number" name="kalori" value="{{ $activity->kalori ?? old('kalori') }}" 
                       class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block mb-1">Waktu</label>
                <input type="datetime-local" name="waktu" 
                       value="{{ $activity ? date('Y-m-d\TH:i', strtotime($activity->waktu)) : old('waktu') }}" 
                       class="w-full p-2 border rounded" required>
            </div>
        </div>

        <div class="flex justify-between">
            <a href="/aktivitas" class="bg-gray-200 px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection