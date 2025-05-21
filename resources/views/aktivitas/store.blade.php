@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 mt-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Riwayat Aktivitas</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($aktivitas->isEmpty())
        <p class="text-gray-600">Belum ada aktivitas yang dicatat.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Nama Aktivitas</th>
                        <th class="px-4 py-2 border">Intensitas</th>
                        <th class="px-4 py-2 border">Durasi (menit)</th>
                        <th class="px-4 py-2 border">Kalori</th>
                        <th class="px-4 py-2 border">Waktu</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aktivitas as $index => $a)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $a->nama }}</td>
                            <td class="px-4 py-2 border">{{ $a->intensitas }}</td>
                            <td class="px-4 py-2 border">{{ $a->durasi }}</td>
                            <td class="px-4 py-2 border">{{ $a->kalori }}</td>
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($a->waktu)->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 border">
                                <form action="{{ route('aktivitas.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus aktivitas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
