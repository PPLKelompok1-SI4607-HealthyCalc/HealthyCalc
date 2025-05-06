@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">Tambah Makanan</h2>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('food_log.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-md space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="food_name" class="block text-sm font-medium text-gray-700">Nama Makanan</label>
                <input type="text" name="food_name" id="food_name" value="{{ old('food_name') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label for="portion" class="block text-sm font-medium text-gray-700">Porsi</label>
                <input type="text" name="portion" id="portion" value="{{ old('portion') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label for="calories" class="block text-sm font-medium text-gray-700">Kalori</label>
                <input type="number" name="calories" id="calories" value="{{ old('calories') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label for="protein" class="block text-sm font-medium text-gray-700">Protein (g)</label>
                <input type="number" name="protein" id="protein" value="{{ old('protein') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label for="carbs" class="block text-sm font-medium text-gray-700">Karbohidrat (g)</label>
                <input type="number" name="carbs" id="carbs" value="{{ old('carbs') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label for="fat" class="block text-sm font-medium text-gray-700">Lemak (g)</label>
                <input type="number" name="fat" id="fat" value="{{ old('fat') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div class="md:col-span-2">
                <label for="consumed_at" class="block text-sm font-medium text-gray-700">Tanggal & Waktu Konsumsi</label>
                <input type="datetime-local" name="consumed_at" id="consumed_at" value="{{ old('consumed_at') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>
        </div>

        <div class="flex justify-between pt-6">
            <button type="submit"
                class="inline-flex items-center px-6 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 shadow">
                <i class="bi bi-plus-circle mr-2"></i> Tambah Makanan
            </button>
            <a href="{{ route('food_log.index') }}"
                class="inline-flex items-center px-6 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded hover:bg-gray-300 shadow">
                <i class="bi bi-arrow-left-circle mr-2"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
