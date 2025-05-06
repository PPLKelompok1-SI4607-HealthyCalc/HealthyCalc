@extends('layouts.tailwind-app')

@section('content')
<div class="container mx-auto py-12">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-center py-12 mb-8 rounded-lg">
        @if($profile && $profile->profile_photo_path)
            <img src="{{ asset('storage/' . $profile->profile_photo_path) }}" class="w-36 h-36 object-cover rounded-full mb-3 mx-auto" alt="Foto Profil">
        @else
            <div class="w-36 h-36 bg-gray-300 rounded-full flex items-center justify-center mb-3 mx-auto">
                <i class="fas fa-user fa-3x text-gray-500"></i>
            </div>
        @endif
        <h1 class="text-2xl font-semibold mb-2">Pengaturan Profil</h1>
        <p class="text-lg">Kelola informasi pribadi dan preferensi kesehatan Anda</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="border-b pb-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Data Pribadi</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p><strong>Nama Lengkap</strong><br>{{ $user->name }}</p>
                    <p><strong>Usia</strong><br>{{ optional($profile)->age ?? '-' }} tahun</p>
                    <p><strong>Tinggi Badan</strong><br>{{ optional($profile)->height ?? '-' }} cm</p>
                </div>
                <div>
                    <p><strong>Email</strong><br>{{ $user->email }}</p>
                    <p><strong>Jenis Kelamin</strong><br>{{ optional($profile)->gender ?? '-' }}</p>
                    <p><strong>Berat Badan</strong><br>{{ optional($profile)->weight ?? '-' }} kg</p>
                </div>
            </div>
        </div>

        <div class="border-b pb-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Tingkat Aktivitas</h3>
            <p>{{ optional($profile)->activity_level ?? '-' }}</p>
        </div>

        <div class="border-b pb-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Preferensi Diet</h3>
            <ul class="list-none">
                @if(optional($profile)->is_vegetarian)
                    <li class="text-green-500"><i class="fas fa-leaf me-2"></i> Vegetarian</li>
                @endif
                @if(optional($profile)->is_low_calorie)
                    <li class="text-blue-500"><i class="fas fa-apple-alt me-2"></i> Rendah Kalori</li>
                @endif
                @if(optional($profile)->is_gluten_free)
                    <li class="text-yellow-500"><i class="fas fa-bread-slice me-2"></i> Bebas Gluten</li>
                @endif
                @if(!optional($profile)->is_vegetarian && !optional($profile)->is_low_calorie && !optional($profile)->is_gluten_free)
                    <li>Tidak ada preferensi diet khusus</li>
                @endif
            </ul>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                <i class="fas fa-edit mr-2"></i>Edit Profil
            </a>
            <form action="{{ route('profile.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus profil?')">
                    <i class="fas fa-trash mr-2"></i>Hapus Profil
                </button>
            </form>
        </div>
    </div>

    <footer class="mt-8 text-center text-sm text-gray-600">
        <p>© {{ date('Y') }} HealthyCalc. All rights reserved.</p>
    </footer>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
