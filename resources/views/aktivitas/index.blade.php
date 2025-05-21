@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Riwayat Aktivitas Fisik</h1>
    
    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500">Total Kalori Terbakar</h3>
            <p class="text-2xl">{{ $totalKalori }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500">Durasi Total</h3>
            <p class="text-2xl">{{ $totalJam }} Jam</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500">Aktivitas Minggu ini</h3>
            <p class="text-2xl">{{ $totalMingguIni }}</p>
        </div>
    </div>

    <!-- Tombol Tambah -->
    <a href="/aktivitas/manage" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        + Tambah Aktivitas
    </a>

    <!-- Daftar Aktivitas -->
    @forelse($activities as $activity)
    <div class="bg-white p-4 rounded shadow mb-4">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="font-bold">{{ $activity->nama }}</h3>
                <p class="text-sm text-gray-500">{{ date('d M Y, H:i', strtotime($activity->waktu)) }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="/aktivitas/manage/{{ $activity->id }}" class="text-blue-500">
                    Edit
                </a>
                <form action="/aktivitas/delete/{{ $activity->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500" onclick="return confirm('Hapus aktivitas ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        
        <div class="grid grid-cols-3 gap-2 mt-2 text-sm">
            <div>
                <span class="text-gray-500">Durasi</span>
                <p>{{ $activity->durasi }} menit</p>
            </div>
            <div>
                <span class="text-gray-500">Intensitas</span>
                <p>{{ $activity->intensitas }}</p>
            </div>
            <div>
                <span class="text-gray-500">Kalori</span>
                <p>{{ $activity->kalori }} kkal</p>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white p-4 rounded shadow text-center">
        <p>Belum ada aktivitas</p>
    </div>
    @endforelse
</div>
@endsection