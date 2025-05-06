@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 shadow-lg rounded-lg">
    @if ($mode == 'form')
        <form action="{{ route('kalori.hitung') }}" method="POST">
            @csrf
            <!-- Form Inputan -->
            <div class="mb-4">
                <label for="usia" class="block text-sm font-medium text-gray-700">Usia</label>
                <input type="number" name="usia" id="usia" class="w-full border-gray-300 border rounded-lg p-2 mt-1" value="{{ old('usia') }}" required>
                @if ($errors->has('usia')) 
                    <p class="text-red-500 text-xs">{{ $errors->first('usia') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border-gray-300 border rounded-lg p-2 mt-1" required>
                    <option value="laki" {{ old('jenis_kelamin') == 'laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @if ($errors->has('jenis_kelamin')) 
                    <p class="text-red-500 text-xs">{{ $errors->first('jenis_kelamin') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="berat_badan" class="block text-sm font-medium text-gray-700">Berat Badan (kg)</label>
                <input type="number" name="berat_badan" id="berat_badan" class="w-full border-gray-300 border rounded-lg p-2 mt-1" value="{{ old('berat_badan') }}" required>
                @if ($errors->has('berat_badan')) 
                    <p class="text-red-500 text-xs">{{ $errors->first('berat_badan') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="tinggi_badan" class="block text-sm font-medium text-gray-700">Tinggi Badan (cm)</label>
                <input type="number" name="tinggi_badan" id="tinggi_badan" class="w-full border-gray-300 border rounded-lg p-2 mt-1" value="{{ old('tinggi_badan') }}" required>
                @if ($errors->has('tinggi_badan')) 
                    <p class="text-red-500 text-xs">{{ $errors->first('tinggi_badan') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="tingkat_aktivitas" class="block text-sm font-medium text-gray-700">Tingkat Aktivitas</label>
                <select name="tingkat_aktivitas" id="tingkat_aktivitas" class="w-full border-gray-300 border rounded-lg p-2 mt-1" required>
                    <option value="rendah" {{ old('tingkat_aktivitas') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ old('tingkat_aktivitas') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ old('tingkat_aktivitas') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
                @if ($errors->has('tingkat_aktivitas')) 
                    <p class="text-red-500 text-xs">{{ $errors->first('tingkat_aktivitas') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="tujuan" class="block text-sm font-medium text-gray-700">Tujuan</label>
                <select name="tujuan" id="tujuan" class="w-full border-gray-300 border rounded-lg p-2 mt-1" required>
                    <option value="turun" {{ old('tujuan') == 'turun' ? 'selected' : '' }}>Turun</option>
                    <option value="jaga" {{ old('tujuan') == 'jaga' ? 'selected' : '' }}>Jaga</option>
                    <option value="naik" {{ old('tujuan') == 'naik' ? 'selected' : '' }}>Naik</option>
                </select>
                @if ($errors->has('tujuan')) 
                    <p class="text-red-500 text-xs">{{ $errors->first('tujuan') }}</p>
                @endif
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded mt-4">Hitung</button>
        </form>
    @elseif ($mode == 'results')
        <h3 class="text-lg font-bold mb-4">Hasil Perhitungan</h3>

        <div>
            <p>Total Kalori: {{ $data['total_kalori'] }} Kcal</p>
            <p>Protein: {{ $data['protein'] }} g ({{ $data['persen_protein'] }}%)</p>
            <p>Lemak: {{ $data['lemak'] }} g ({{ $data['persen_lemak'] }}%)</p>
            <p>Karbohidrat: {{ $data['karbohidrat'] }} g ({{ $data['persen_karbohidrat'] }}%)</p>
        </div>

        <a href="{{ route('kalori.reset') }}" class="bg-red-500 text-white py-2 px-4 rounded mt-4 inline-block">Reset</a>
    @endif
</div>
@endsection
