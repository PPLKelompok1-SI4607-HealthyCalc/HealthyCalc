@extends('layouts.tailwind-app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold">Selamat Datang, {{ $user->username }}!</h1>
</div>

<div class="py-8">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Dashboard</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Riwayat Konsumsi --}}
        <x-dashboard.card 
            icon="bi-journal-text"
            color="text-blue-500"
            title="Riwayat Konsumsi"
            text="Lihat dan kelola riwayat konsumsi makanan Anda."
            route="{{ route('food_log.index') }}"
            btn="Lihat Riwayat"
            btnColor="bg-blue-500 hover:bg-blue-600"
        />

        {{-- Hitung Kalori --}}
        <x-dashboard.card 
            icon="bi-calculator"
            color="text-green-500"
            title="Hitung Kalori"
            text="Hitung kebutuhan kalori harian Anda."
            route="{{ route('kalori.index') }}"
            btn="Hitung Kalori"
            btnColor="bg-green-500 hover:bg-green-600"
        />

        {{-- Defisit Kalori --}}
        <x-dashboard.card 
            icon="bi-graph-down-arrow"
            color="text-red-500"
            title="Defisit Kalori"
            text="Pantau defisit kalori Anda untuk mencapai tujuan."
            route="{{ route('simulasi-defisit.index') }}"
            btn="Lihat Defisit"
            btnColor="bg-red-500 hover:bg-red-600"
        />

        {{-- Resep Makanan --}}
        <x-dashboard.card 
            icon="bi-book"
            color="text-yellow-500"
            title="Resep Makanan"
            text="Temukan resep makanan sehat untuk Anda."
            route="{{ route('recipes.index') }}"
            btn="Lihat Resep"
            btnColor="bg-yellow-500 hover:bg-yellow-600"
        />

        {{-- Edit Profil --}}
        <x-dashboard.card 
            icon="bi-person-circle"
            color="text-indigo-500"
            title="Edit Profil"
            text="Perbarui informasi profil Anda."
            route="{{ route('profile.edit') }}"
            btn="Edit Profil"
            btnColor="bg-indigo-500 hover:bg-indigo-600"
        />

        {{-- Tambah Asupan --}}
        <x-dashboard.card 
            icon="bi-plus-circle"
            color="text-gray-500"
            title="Tambah Asupan"
            text="Tambahkan makanan ke dalam riwayat konsumsi Anda."
            route="{{ route('food-intakes.create') }}"
            btn="Tambah Asupan"
            btnColor="bg-gray-500 hover:bg-gray-600"
        />
    </div>
</div>
@endsection
